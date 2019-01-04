<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2018, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Search extends EmptyItem {
  private $uris = [];
  private $htmlName = 'search';

  public static function allJsonPath() {
    return PATH . 'js' . DIRECTORY_SEPARATOR . 'all.json';
  }

  public static function allJsonUrl() {
    return BASE_URL . 'js/all.json';
  }

  public function writeHtml() {
    return fileWrite($this->htmlPath(), loadView(PATH_TEMPLATE . 'Search.php', [
      '_header' => loadView(PATH_TEMPLATE . '_header.php'),
      '_menu' => loadView(PATH_TEMPLATE . '_menu.php'),
      'search' => $this,
      '_info' => loadView(PATH_TEMPLATE . '_info.php'),
    ]));
  }

  public function htmlPath() {
    return PATH . ($this->uris ? implode(DIRECTORY_SEPARATOR, $this->uris) . DIRECTORY_SEPARATOR : '') . $this->htmlName . '.html';
  }
}