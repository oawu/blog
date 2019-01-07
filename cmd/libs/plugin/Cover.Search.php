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
      '_header' => loadView(PATH_TEMPLATE . '_header.php'),
      '_menu' => loadView(PATH_TEMPLATE . '_menu.php'),
      '_info' => loadView(PATH_TEMPLATE . '_info.php'),
    ]));
  }
}