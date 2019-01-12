<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

abstract class Menu {
  const FORMAT = '/^(?P<id>\d{3})\s+\|\s+(?P<key>.*)/';
  private static $all = null;
  protected $class = '', $text = '', $subText = '', $currentUrl = null;

  public static function all() {
    if (self::$all !== null)
      return self::$all;

    self::$all = array_values(array_filter([
      ArticleIndex::create('001 | index',    'icon-d',  '網站首頁', '網站首頁'),
          Articles::create('002 | Develop',  'icon-e',  '開發心得', '前後端的實作心得，相關資訊技術研究筆記。'),
          Articles::create('003 | MacOSNote',    'icon-1b', '蘋果環境', 'MacOS 重灌完後，開發環境的建置。', 'asc'),
          Articles::create('004 | Mazu',     'icon-1a', '鄉土北港', '不只是熱情也不僅僅是信仰，更是一種習慣、參與感、責任感。'),
          Articles::create('005 | Blog',     'icon-1e', '生活文章', '現在還流行部落格嗎？不管，我就是想寫！'),
          Articles::create('006 | Unboxing', 'icon-f',  '開箱文章', 'OA 的玩具開箱文，意外與驚喜的收納盒。'),
          Articles::create('007 | Food',     'icon-1f', '景點美食', '吃吃走走、走走吃吃，到處吃吃喝喝的筆記本。'),
            Albums::create('008 | Album',    'icon-14', '生活相簿', '點點滴滴，喜歡用相簿紀錄每次精彩的活動。'),
    ]));

    SingleItem::initAll('AllJson', 'Search', 'License', 'Sitemap', 'Robots', 'GoogleVerification', 'Page404');
  
    Item::modifyAllContent();
    return self::$all;
  }

  public static function create() {
    $args = func_get_args();
    $dirName = array_shift($args);
    $class = array_shift($args);
    $text = array_shift($args);
    $subText = array_shift($args);

    $descSort = array_shift($args);
    $descSort && $descSort = strtolower(trim($descSort));
    in_array($descSort, ['asc', 'desc']) || $descSort = 'desc';
    $descSort = $descSort == 'desc';

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
      return $staticClass::init($tmp, [$key], $descSort)
                         ->setClass($class)
                         ->setText($text)
                         ->setSubText($subText);

    if (!is_file($tmp . Item::INDEX_MD))
      return null;

    if (!is_readable($tmp . Item::INDEX_MD))
      return null;

    return $staticClass::init($tmp, $key, [])
                       ->setClass($class)
                       ->setText($text)
                       ->setSubText($subText);
  }

  public function setClass($class) {
    $this->class = $class;
    return $this;
  }

  public function setText($text) {
    $this->text = $text;
    return $this;
  }

  public function setSubText($subText) {
    $this->subText = $subText;
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

  public function subText() {
    return $this->subText;
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