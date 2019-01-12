<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Robots extends SingleItem {
  protected static function uris() { return []; }
  protected static function format() { return 'txt'; }
  protected static function fileName() { return 'robots'; }

  public static function write() {
    return fileWrite(static::writePath(), loadView(PATH_TEMPLATE . 'Robots.php'));
  }
}