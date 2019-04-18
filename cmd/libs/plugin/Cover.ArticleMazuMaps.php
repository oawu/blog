<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class ArticleMazuMaps extends Article {
  public function others($length = 4) {
    $groups = array_filter(Menu::all(), function($menu) {
      return $menu instanceof Items;
    });
    
    return array_slice($groups, 0, $length);
  }

  public function write() {
    return fileWrite($this->writePath(), loadView(PATH_TEMPLATE . 'ArticleMazuMaps.php', [
      '_header' => loadView(PATH_TEMPLATE . '_header.php'),
      '_menu' => loadView(PATH_TEMPLATE . '_menu.php', ['currentUrl' => $this->currentUrl()]),
      'article' => $this,
      '_info' => loadView(PATH_TEMPLATE . '_info.php'),
    ]));
  }
}