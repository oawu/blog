<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class GoogleVerification extends SingleItem {
  protected static function uris() { return []; }
  protected static function format() { return 'html'; }
  protected static function fileName() { return 'googlefabb4040c4c7f309'; }

  public static function write() {
    return fileWrite(static::writePath(), loadView(PATH_TEMPLATE . 'GoogleVerification.php', [
      'value' => 'googlefabb4040c4c7f309.html'
    ]));
  }
}