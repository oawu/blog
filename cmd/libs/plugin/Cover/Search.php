<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Search extends SingleItem {
  protected static function uris() { return []; }
  protected static function format() { return 'html'; }
  protected static function fileName() { return 'search'; }

  public static function write() {
    return fileWrite(static::writePath(), loadView(PATH_TEMPLATE . 'Search.php', [
      '_Checkbox' => loadView(PATH_TEMPLATE . '_Checkbox.php'),
      '_Header' => loadView(PATH_TEMPLATE . '_Header.php'),
      '_Menu' => loadView(PATH_TEMPLATE . '_Menu.php'),
      '_Info' => loadView(PATH_TEMPLATE . '_Info.php'),
    ]));
  }
}