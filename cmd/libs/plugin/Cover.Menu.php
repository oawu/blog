<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2018, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

abstract class Menu {
  const FORMAT = '/^(?P<id>\d{3})\s+\|\s+(?P<key>.*)/';
  private static $all = null;
  protected $class = '', $text = '', $currentUrl = null;

  public static function all() {
    if (self::$all !== null)
      return self::$all;

    self::$all = array_values(array_filter([
      ArticleIndex::create('001 | index', 'icon-d', '網站首頁'),
      Articles::create('002 | develop', 'icon-e', '心得筆記'),
      Articles::create('003 | unboxing', 'icon-f', '開箱文章'),
      Articles::create('004 | mazu', 'icon-20', '鄉土北港'),
      Albums::create('005 | album', 'icon-14', '生活相簿'),
    ]));
  
    Item::modifyAllContent();
    return self::$all;
  }

  public static function create($dirName, $class, $text) {
    if (!preg_match_all(self::FORMAT, $dirName, $matches))
      return null;

    if (empty($matches['id']) || !($id = array_shift($matches['id'])))
      return null;

    if (empty($matches['key']) || !($key = array_shift($matches['key'])))
      return null;

    if (!is_dir($tmp = PATH_MARKDOWN . $dirName . DIRECTORY_SEPARATOR))
      return null;

    if (!is_readable($tmp))
      return null;

    $staticClass = static::class;

    if (!(is_subclass_of($staticClass, 'Items') || is_subclass_of($staticClass, 'Item')))
      return null;
    
    if (is_subclass_of($staticClass, 'Items'))
      return $staticClass::init($tmp, [$key])
                         ->setClass($class)
                         ->setText($text);

    if (!is_file($tmp . Item::INDEX_MD))
      return null;

    if (!is_readable($tmp . Item::INDEX_MD))
      return null;

    return $staticClass::init($tmp, $key, [])
                       ->setClass($class)
                       ->setText($text);
  }

  public function setClass($class) {
    $this->class = $class;
    return $this;
  }

  public function setText($text) {
    $this->text = $text;
    return $this;
  }

  public function setCurrentUrl($currentUrl) {
    $this->currentUrl = $currentUrl;
    return $this;
  }

  public function className() {
    return $this->class;
  }

  public function text() {
    return $this->text;
  }

  public function currentUrl() {
    return $this->currentUrl;
  }

  public static function links($currentUrl = null) {
    return array_map(function($menu) use ($currentUrl) {
      $attrs = [
        'href' => $menu->url(),
        'class' => $menu->className() . ($currentUrl && $currentUrl == $menu->url() ? ' a' : ''),
        'data-cnt' => $menu instanceof Items ? count($menu->items()) : null,
      ];

      echo '<a' . attr($attrs) . '>' . $menu->text() . '</a>';
    }, self::all());
  }

  abstract public function url();
}