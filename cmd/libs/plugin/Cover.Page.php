<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Page {
  const OFFSET = 12;
  const DIR_NAME = 'pages';

  private $index, $items, $pagination, $uris;

  public function __construct($index, $uris, $items) {
    $this->index = $index;
    $this->items = $items;
    $this->uris  = $uris;
    $this->pagination = '';

    foreach ($this->items as $item)
      $item->setPage($this);
  }

  public static function create($index, $uris, $items) {
    return new static($index, $uris, $items);
  }
  
  public function index() {
    return $this->index;
  }

  public function items() {
    return $this->items;
  }

  public function uris() {
    return $this->uris;
  }

  public function pagination() {
    return $this->pagination;
  }

  public function setPagination($pagination) {
    $this->pagination = $pagination;
    return $this;
  }

  public function htmlName() {
    return $this->index ? $this->index + 1 : 'index';
  }

  public function url() {
    return BASE_URL . ($this->uris ? implode('/', array_map('rawurlencode', $this->uris)) . '/' : '') . trim(Page::DIR_NAME, '/') . '/' . rawurlencode($this->htmlName()) . '.html';
  }

  public function writePath() {
    return PATH . ($this->uris ? implode(DIRECTORY_SEPARATOR, $this->uris) . DIRECTORY_SEPARATOR : ''). trim(Page::DIR_NAME, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->htmlName() . '.html';
  }
}
