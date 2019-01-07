<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

abstract class Items extends Menu {
  const ITEM_FORMAT_WITH_CREATE_AT = '/^(?P<createAt>\d\d\d\d\.(0?[1-9]|1[0-2])\.(0?[1-9]|[12][0-9]|3[01]))\s+\|\s+(?P<fileName>.*)/';
  const ITEM_FORMAT_WITH_ID = '/^(?P<id>\d+)\s+\|\s+(?P<fileName>.*)/';

  protected $items = [], $pages = [], $uris = [], $markdownPath, $desc = true;
  private static $all = [];

  public function __construct($dirPath, $uris, $desc) {
    $this->desc = $desc;

    $this->items = array_values(array_filter(array_map(function($item) use ($dirPath, $uris) {
      
      if (preg_match_all(Items::ITEM_FORMAT_WITH_CREATE_AT, $item, $matches)) {
        if (empty($matches['createAt']) || !($createAt = array_shift($matches['createAt'])) || ($createAt = DateTime::createFromFormat('Y.m.d', $createAt)) === false)
          $createAt = null;
      } else if (preg_match_all(Items::ITEM_FORMAT_WITH_ID, $item, $matches)) {
        $createAt = null;
      } else {
        return null;
      }

      if (empty($matches['fileName']) || !($fileName = array_shift($matches['fileName'])))
        return null;

      if (!is_dir($tmp = $dirPath . $item . DIRECTORY_SEPARATOR))
        return null;

      if (!is_readable($tmp))
        return null;

      if (!is_file($tmp . Item::INDEX_MD))
        return null;
      
      if (!is_readable($tmp . Item::INDEX_MD))
        return null;
      
      if (!class_exists($class = static::CHILD_CLASS))
        return null;

      return $class::init($tmp, $fileName, $uris, $createAt);
    }, @scandir($dirPath) ?: [])));
    
    $this->uris = $uris;
    $this->markdownPath = $dirPath;

    $this->pages = [];

    for ($i = 0, $j = 0, $c = count($items = $this->desc ? array_reverse($this->items()) : $this->items()); $i < $c; $i += Page::OFFSET)
      if ($page = Page::create($j++, $uris, array_slice($items, $i, Page::OFFSET)))
        array_push($this->pages, $page);

    $this->pages || $this->pages = [Page::create(0, $uris, [])];

    foreach ($this->pages as $page)
      $page->setPagination(Pagination::create($page, $this->pages));

    foreach ($this->items() as $item)
      $item->setCurrentUrl($this->url())
           ->setItems($this);
    
    $this->setCurrentUrl($this->url());

    Items::append($this);
  }

  public function pages() { return $this->pages; }
  public function uris() { return $this->uris; }
  public function markdownPath() { return $this->markdownPath; }
  public function url() { return $this->pages[0]->url(); }

  public static function existsByMarkdownPath($markdownPath = null) {
    return array_key_exists($markdownPath, Items::$all) ? Items::$all[$markdownPath] : null;
  }

  public static function append(Items $items) {
    Items::$all[$items->markdownPath()] = $items;
    return $items;
  }

  public function items() {
    return $this->items;
  }

  public static function init($dirPath, $uris, $desc) {
    return new static($dirPath, $uris, $desc);
  }

  abstract public function write();
}