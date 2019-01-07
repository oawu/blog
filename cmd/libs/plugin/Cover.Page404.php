<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Page404 extends SingleItem {
  protected static function uris() { return []; }
  protected static function format() { return 'html'; }
  protected static function fileName() { return '404'; }

  public static function write() {
    return fileWrite(static::writePath(), loadView(PATH_TEMPLATE . '404.php', [
      '_header' => loadView(PATH_TEMPLATE . '_header.php'),
      '_menu' => loadView(PATH_TEMPLATE . '_menu.php'),
      '_info' => loadView(PATH_TEMPLATE . '_info.php'),
    ]));
  }
}