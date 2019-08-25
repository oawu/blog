<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class AllJson extends SingleItem {
  protected static function uris() { return []; }
  protected static function format() { return 'json'; }
  protected static function fileName() { return 'all'; }

  public static function write() {
    $items = array_values(array_filter(array_reverse(Item::all()), function($item) {
      return $item->items() && ($item instanceof Article || $item instanceof Album);
    }));

    $all = [];
    foreach ($items as $item) {
      isset($all[$key = $item->items()->url()]) || $all[$key] = [
        't' => $item->items()->text(),
        'u' => $item->items()->url(),
        's' => []
      ];

      array_push($all[$key]['s'], [
        't' => $item->title,
        'd' => $item->description,
        'h' => $item->tags,
        'u' => $item->url(),
        'i' => $item->ogImage
      ]);
    }

    return fileWrite(static::writePath(), json_encode(array_values($all)));
  }
}