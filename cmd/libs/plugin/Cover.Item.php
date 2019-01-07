<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

abstract class Item extends Menu {
  const INDEX_MD = 'readme.md';
  const IMG_FORMATS = ['jpg', 'jpeg', 'gif', 'png'];

  private static $groups = [];
  private static $all = [];

  protected $markdownPath, $fileName, $uris = [], $page = null, $items = null;
  public $title, $description, $bio, $ogImage, $iconImage, $content, $tags, $createAt, $updateAt;

  public function setPage(Page $page) { $this->page = $page; return $this; }
  public function setMarkdownPath($markdownPath) { $this->markdownPath = $markdownPath; return $this; }
  public function setHtmlName($fileName) { $this->fileName = $fileName; return $this; }
  public function setUris($uris) { $this->uris = $uris; return $this; }
  public function setItems(Items $items) { $this->items = $items; return $this; }

  public static function init($markdownPath, $fileName, $uris, $createAt = null) {
    
    array_key_exists($key = implode('_', $uris), Item::$groups) || Item::$groups[$key] = [];

    $i = '';
    while(true) {
      if (!Item::existsByUris($fileName . $i, $key))
        break;
      $i = $i ? ++$i : 2;
    }

    $obj = new static();
    $obj->setMarkdownPath($markdownPath);
    $obj->setHtmlName($fileName . $i);
    $obj->setUris($uris);
    $obj->createAt = $createAt;
    $obj->setCurrentUrl($obj->url());

    return Item::append($key, $obj);
  }

  public function sitemap() {
    
    return [
      'loc' => $this->url(),
      'priority' => $this->uris() ? '0.7' : '0.3',
      'changefreq' => 'daily',
      'lastmod' => $this->updateAt->format('c'),
      'images' => isset($this->images) ? array_slice(array_map(function($image) {
        return [
          'loc' => $image['src'],
          'title' => $this->title,
          'caption' => $image['alt'] ? $image['alt'] : $this->title,
          'license' => License::url(),
        ];
      }, $this->images), 0, 1000) : null
    ];
  }

  public function markdownPath() { return $this->markdownPath; }
  public function fileName() { return $this->fileName; }
  public function uris() { return $this->uris; }
  
  public function url() { return BASE_URL . ($this->uris ? implode('/', array_map('rawurlencode', $this->uris)) . '/' : '') . rawurlencode($this->fileName) . '.html'; }
  public function writePath() { return PATH . ($this->uris ? implode(DIRECTORY_SEPARATOR, $this->uris) . DIRECTORY_SEPARATOR : '') . $this->fileName . '.html'; }
  public function page() { return $this->page; }
  public function items() { return $this->items; }

  public static function existsByUris($fileName, $key = null) {
    $groups = array_key_exists($key, Item::$groups) ? [Item::$groups[$key]] : Item::$groups;

    foreach ($groups as $group)
      foreach ($group as $item)
        if ($item->fileName() == $fileName)
          return true;

    return false;
  }

  public static function append($key, Item $item) {
    array_push(Item::$groups[$key], $item);
    Item::$all[$item->markdownPath()] = $item;
    return $item;
  }

  public static function existsByMarkdownPath($markdownPath = null) {
    return array_key_exists($markdownPath, Item::$all) ? Item::$all[$markdownPath] : null;
  }

  public static function modifyAllContent() {
    foreach (Item::$groups as $key => $items)
      foreach ($items as $item)
        $item->modifyContent();
  }

  public static function groups() {
    return Item::$groups;
  }

  public static function all() {
    return Item::$all;
  }

  public function modifyContent() {
    return $this->getContent()
                ->coverContentToHtml()
                ->coverImages()
                ->coverLinks()
                ->getContentModifyAt()
                ->getContentTags()
                ->getContentOgImage()
                ->getContentIconImage()
                ->getContentDescription()
                ->getContentTitle()
                ->removeContentLn()
                ;
  }

  protected function getContent() {
    $this->content = fileRead($this->markdownPath() . Item::INDEX_MD);
    return $this;
  }

  protected function coverContentToHtml() {
    $parsedown = new Parsedown();
    $this->removeContentLn();
    $this->content = $parsedown->text($this->content);
    $this->replaceContentSpace('/<!--(.*)-->/u');
    return $this;
  }

  protected function replaceContentSpace($pattern, $removeLn = true) {
    $this->content = preg_replace($pattern, '', $this->content);
    return $removeLn ? $this->removeContentLn() : $this;
  }

  protected function removeContentLn() {
    return $this->replaceContentSpace('/^[\n ]*|[\n ]*$/u', false);
  }

  protected function coverImages() {
    $pattern = '/<img.*?src=(["\'])(?P<imgs>.*?)\1[^\>]*>/u';

    $images = preg_match_all($pattern, $this->content, $matches) ? array_filter(array_map(function($img) {
      if (preg_match('/^https?:\/\/.*/ui', $img) || preg_match('/^mailto:/ui', $img) || preg_match('/^tel:/ui', $img) || preg_match('/^s?ftp:/ui', $img)) {
        return [
          'search' => $img,
          'replace' => $img,
        ];
      }

      return [
        'search' => $img,
        'replace' => is_readable($file = realpath($this->markdownPath() . $img)) ? BASE_URL . implode('/', array_map('rawurlencode', explode(DIRECTORY_SEPARATOR, pathReplace(PATH, $file)))) : D4_IMG_URL,
      ];
    }, array_unique(array_filter($matches['imgs'], function($t) {
      return $t;
    })))) : [];

    $tmps = [];
    foreach ($images as $image)
      if (!isset($tmps[$image['search']]))
        $tmps[$image['search']] = $image['replace'];

    $pattern = '/<img.*?src=(["\'])(.*?)\1([^\>]*)>/u';

    $this->content = preg_replace_callback($pattern, function($matches) use ($tmps) {
      return '<img src=' . $matches[1] . (isset($tmps[$matches[2]]) ? $tmps[$matches[2]] : D4_IMG_URL) . $matches[1] . $matches[3] . '>';
    }, $this->content);

    return $this;
  }

  protected function coverLinks() {
    $pattern = '/<a.*?href=(["\'])(?P<hrefs>.*?)\1[^\>]*>/u';
    
    $links = preg_match_all($pattern, $this->content, $matches) ? array_filter(array_map(function($href) {
      if (preg_match('/^https?:\/\/.*/ui', $href) || preg_match('/^mailto:/ui', $href) || preg_match('/^tel:/ui', $href) || preg_match('/^s?ftp:/ui', $href))
        return [
          'search' => $href,
          'replace' => $href,
        ];

      if (!is_readable($search = realpath($this->markdownPath() . $href)))
        return [
          'search' => $href,
          'replace' => BASE_URL . '404.html'
        ];

      $search = (is_dir($search) ? $search : dirname($search)) . DIRECTORY_SEPARATOR;

      if (($tmp = Items::existsByMarkdownPath($search)) !== null)
        return [
          'search' => $href,
          'replace' => $tmp->url()
        ];

      if (($tmp = Item::existsByMarkdownPath($search)) !== null)
        return [
          'search' => $href,
          'replace' => $tmp->url()
        ];

      return [
        'search' => $href,
        'replace' => BASE_URL . '404.html'
      ];
    }, array_unique(array_filter($matches['hrefs'], function($t) {
      return $t;
    })))) : [];

    $tmps = [];
    foreach ($links as $link)
      if (!isset($tmps[$link['search']]))
        $tmps[$link['search']] = $link['replace'];

    $pattern = '/<a.*?href=(["\'])(?P<hrefs>.*?)\1[^\>]*>/u';
    
    $this->content = preg_replace_callback($pattern, function($matches) use ($tmps) {
      return '<a href=' . $matches[1] . (isset($tmps[$matches[2]]) ? $tmps[$matches[2]] : $matches[2]) . $matches[1] . '>';
    }, $this->content);

    return $this;
  }

  protected function getContentModifyAt() {
    $pattern = '/<p[^>]*?>(?P<updateAt>\d\d\d\d[-.](0?[1-9]|1[0-2])[-.](0?[1-9]|[12][0-9]|3[01])( (00|[0-9]|1[0-9]|2[0-3]):([0-9]|[0-5][0-9])(:([0-9]|[0-5][0-9]))?)?)<\/p>$/u';

    if ($this->updateAt = preg_match_all($pattern, $this->content, $matches) && isset($matches['updateAt'][0]) ? $matches['updateAt'][0] : '')
      $this->replaceContentSpace($pattern);

    if ($this->updateAt)
      foreach (['Y-m-d', 'Y.m.d', 'Y-m-d H:i', 'Y-m-d H:i:s', 'Y.m.d H:i', 'Y.m.d H:i:s'] as $format)
        if (($tmp = DateTime::createFromFormat($format, $this->updateAt)) !== false && ($this->updateAt = $tmp))
          break;

    $this->updateAt instanceof DateTime || $this->updateAt = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s', filemtime($this->markdownPath() . Item::INDEX_MD)));
    $this->updateAt instanceof DateTime || $this->updateAt = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
    $this->createAt instanceof DateTime || $this->createAt = $this->updateAt;

    return $this;
  }

  protected function getContentTags() {
    $this->tags = [];

    $pattern = '/<p.*?>\s*(?P<tags><code.*?>.+?<\/code>)\s*<\/p>$/u';
    if (!$tags = preg_match_all($pattern, $this->content, $matches) && isset($matches['tags'][0]) ? $matches['tags'][0] : [])
      return $this;

    $tags = implode('</code><code>', (explode('``', $tags)));

    if (!$tags = preg_match_all('/<code.*?>#(?P<tags>.+?)<\/code>/u', $tags, $matches) ? $matches['tags'] : [])
      return $this;

    $this->tags = array_filter(array_map(function($tag) { return trim($tag); }, $tags));
    $this->replaceContentSpace($pattern);

    return $this;
  }

  protected function getContentOgImage() {
    $this->ogImage = D4_IMG_URL;

    foreach (Item::IMG_FORMATS as $format)
      if (file_exists($file = $this->markdownPath() . 'cover.' . $format) && is_readable($file))
        $this->ogImage = BASE_URL . implode('/', array_map('rawurlencode', explode(DIRECTORY_SEPARATOR, pathReplace(PATH, realpath($file)))));

    return $this;
  }

  protected function getContentIconImage() {
    $this->iconImage = $this->ogImage;

    foreach (Item::IMG_FORMATS as $format)
      if (file_exists($file = $this->markdownPath() . 'icon.' . $format) && is_readable($file))
        $this->iconImage = BASE_URL . implode('/', array_map('rawurlencode', explode(DIRECTORY_SEPARATOR, pathReplace(PATH, realpath($file)))));

    return $this;
  }

  protected function getContentDescription() {
    $this->bio = '';
    $this->description = DESCRIPTION;
    $pattern = '/^<p[^>]*?>(?P<desc>.*)<\/p>/u';

    if ($this->bio = preg_match_all($pattern, $this->content, $matches) && isset($matches['desc'][0]) ? $matches['desc'][0] : '') {
      $this->replaceContentSpace($pattern);
      $this->description = $this->bio;
    } else {
      $this->description = $this->content;
    }

    $this->bio && $this->bio = mb_strimwidth(removeHtmlTag($this->description), 0, 300, '…','UTF-8');
    $this->description = mb_strimwidth(removeHtmlTag($this->description), 0, 300, '…','UTF-8');
    return $this;
  }

  protected function getContentTitle() {
    $this->title = TITLE;
    $pattern = '/^<h1[^>]*?>(?P<title>.*)<\/h1>/u';

    if ($this->title = preg_match_all($pattern, $this->content, $matches) && isset($matches['title'][0]) ? $matches['title'][0] : '')
      $this->replaceContentSpace($pattern);

    return $this;
  }
  
  abstract public function write();
}