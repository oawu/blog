<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class IndexArticle extends Article {
  public function others($length = 4) {
    $groups = array_filter(Menu::all(), function($menu) {
      return $menu instanceof Items;
    });
    
    return array_slice($groups, 0, $length);
  }

  public function write() {
    return fileWrite($this->writePath(), loadView(PATH_TEMPLATE . 'IndexArticle.php', [
      '_Checkbox' => loadView(PATH_TEMPLATE . '_Checkbox.php'),
      '_Header' => loadView(PATH_TEMPLATE . '_Header.php'),
      '_Menu' => loadView(PATH_TEMPLATE . '_Menu.php', ['currentUrl' => $this->currentUrl()]),
      '_Info' => loadView(PATH_TEMPLATE . '_Info.php'),

      'article' => $this,
    ]));
  }
}