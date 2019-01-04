<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2018, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

abstract class EmptyItem {
  private static $all = [];
  
  public static function create() {
    $obj = new static();
    array_push(EmptyItem::$all, $obj);
    return $obj;
  }


  public static function all() {
    return EmptyItem::$all;
  }
 
  abstract public function writeHtml();
  abstract public function htmlPath();
}