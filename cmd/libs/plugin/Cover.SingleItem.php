<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

abstract class SingleItem {

  abstract protected static function uris();
  abstract protected static function format();
  abstract protected static function htmlName();

  public static function url() {
    return BASE_URL . (static::uris() ? implode('/', static::uris()) . '/' : '') . static::htmlName() . '.' . static::format();
  }

  public static function writePath() {
    return PATH . (static::uris() ? implode(DIRECTORY_SEPARATOR, static::uris()) . DIRECTORY_SEPARATOR : '') . static::htmlName() . '.' . static::format();
  }

  abstract static public function write();
}