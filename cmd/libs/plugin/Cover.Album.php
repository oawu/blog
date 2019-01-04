<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Album extends Item {
  public $images = [];

  protected function coverImages() {
    $pattern = '/<img.*?src=(["\'])(?P<imgs>.*?)\1[^\>]*>/u';

    $images = preg_match_all($pattern, $this->content, $matches) ? array_filter(array_map(function($img) {
      return [
        'search' => $img,
        'replace' => is_readable($file = realpath($this->markdownPath() . $img)) ? BASE_URL . implode('/', array_map('rawurlencode', explode(DIRECTORY_SEPARATOR, pathReplace(PATH, $file)))) : D4_IMG_URL,
      ];
    }, array_unique(array_filter($matches['imgs'], function($t) {
      return $t && !preg_match('/^https?:\/\/.*/ui', $t) && !preg_match('/^mailto:/ui', $t) && !preg_match('/^tel:/ui', $t) && !preg_match('/^s?ftp:/ui', $t);
    })))) : [];

    $tmps = [];
    foreach ($images as $image)
      if (!isset($tmps[$image['search']]))
        $tmps[$image['search']] = $image['replace'];

    $pattern = '/<img.*?src=(["\'])(.*?)\1(.*?alt=(["\'])(.*?)\1)?([^\>]*)>/u';

    $this->content = preg_replace_callback($pattern, function($matches) use ($tmps) {
      if (isset($tmps[$matches[2]]) && $tmps[$matches[2]] != D4_IMG_URL)
        array_push($this->images, [
          'src' => $tmps[$matches[2]],
          'alt' => $matches[5]
        ]);
      return '';
    }, $this->content);

    $pattern = '/<p[^>]*?>\s*<\/p>/u';
    $this->content = preg_replace($pattern, '', $this->content);

    $this->images = array_values($this->images);
    $oasort = oasort(count($this->images));

    foreach ($this->images as $i => &$image)
      $image['class'] = isset($oasort[$i]) ? $oasort[$i] : 'n11';

    return $this;
  }
  public function write() {
    return fileWrite($this->writePath(), loadView(PATH_TEMPLATE . 'Album.php', [
      '_header' => loadView(PATH_TEMPLATE . '_header.php', ['item' => $this]),
      '_menu' => loadView(PATH_TEMPLATE . '_menu.php', ['currentUrl' => $this->currentUrl()]),
      'album' => $this,
      '_info' => loadView(PATH_TEMPLATE . '_info.php'),
    ]));
  }
}