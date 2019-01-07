<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Sitemap extends SingleItem {
  private $writer;
  private $path;
  private $filename = 'sitemap';
  private $current_item = 0;
  private $current_sitemap = 0;

  const SCHEMA = 'http://www.sitemaps.org/schemas/sitemap/0.9';
  const DEFAULT_PRIORITY = 0.5;
  const ITEM_PER_SITEMAP = 200;

  const FILENAME = 'sitemap';
  const SEPERATOR = '_';
  const INDEX_SUFFIX = 'index';

  public function __construct() {
  }

  public static function create() {
    return new static();
  }

  private function getWriter() {
    return $this->writer;
  }

  private function setWriter(XMLWriter $writer) {
    $this->writer = $writer;
  }

  private function getPath() {
    return $this->path;
  }

  public function setPath($path) {
    $this->path = $path;
    return $this;
  }


  private function getCurrentItem() {
    return $this->current_item;
  }

  private function incCurrentItem() {
    $this->current_item = $this->current_item + 1;
  }

  private function getCurrentSitemap() {
    return $this->current_sitemap;
  }

  private function incCurrentSitemap() {
    $this->current_sitemap = $this->current_sitemap + 1;
  }

  private function startSitemap() {
    $this->setWriter(new XMLWriter());
    $this->getWriter()->openURI($this->getPath() . self::FILENAME . self::SEPERATOR . $this->getCurrentSitemap() . '.' . self::format());
    $this->getWriter()->startDocument('1.0', 'UTF-8');
    $this->getWriter()->setIndent(true);
    $this->getWriter()->startElement('urlset');
    $this->getWriter()->writeAttribute('xmlns', self::SCHEMA);
  }

  public function add() {
    if (($this->getCurrentItem() % self::ITEM_PER_SITEMAP) == 0) {
      if ($this->getWriter() instanceof XMLWriter)
        $this->endSitemap();

      $this->startSitemap();
      $this->incCurrentSitemap();
    }

    $this->incCurrentItem();
    return $this;
  }

  public function addItems($items) {
    foreach ($items as $item)
      $this->addItem($item->sitemap());
    return $this;
  }

  public function addItem($params) {
    if (!isset($params['loc']))
      return $this;

    $this->add()
         ->getWriter()->startElement('url');

    foreach ($params as $key => $param)
      if (in_array($key, ['loc', 'priority', 'changefreq', 'lastmod']))
        $this->getWriter()->writeElement($key, $param);

    if (isset($params['images']) && ($images = array_filter($params['images'], function($image) { return isset($image['loc']); }))) {
      foreach ($images as $image) {
        $this->getWriter()->startElement('image:image');
        foreach ($image as $iKey => $img)
          if (in_array($iKey, ['loc', 'caption', 'geo_location', 'title', 'license']))
            $this->getWriter()->writeElement('image:' . $iKey, $img);
        $this->getWriter()->endElement();
      }
    }

    $this->getWriter()->endElement();
    return $this;
  }

  private function endSitemap() {
    $this->getWriter()->endElement();
    $this->getWriter()->endDocument();
    return $this;
  }

  public function createSitemapIndex($loc, $lastmod = 'Today') {
    $this->endSitemap();
    $indexwriter = new XMLWriter();
    $indexwriter->openURI($this->getPath() . self::fileName() . '.' . self::format());
    $indexwriter->startDocument('1.0', 'UTF-8');
    $indexwriter->setIndent(true);
    $indexwriter->startElement('sitemapindex');
    $indexwriter->writeAttribute('xmlns', self::SCHEMA);
    for ($index = 0; $index < $this->getCurrentSitemap(); $index++) {
      $indexwriter->startElement('sitemap');
      $indexwriter->writeElement('loc', $loc . self::FILENAME . self::SEPERATOR . $index . '.' . self::format());
      $indexwriter->writeElement('lastmod', $lastmod);
      $indexwriter->endElement();
    }
    $indexwriter->endElement();
    $indexwriter->endDocument();
    return $this;
  }

  protected static function uris() { return ['sitemap']; }
  protected static function format() { return 'xml'; }
  protected static function fileName() { return self::FILENAME . self::SEPERATOR . self::INDEX_SUFFIX; }

  public static function write() {
    return Sitemap::create()
                  ->setPath(PATH_SITEMAP)
                  ->addItems(Item::all())
                  ->createSitemapIndex(BASE_URL . implode('/', array_map('rawurlencode', explode(DIRECTORY_SEPARATOR, pathReplace(PATH, PATH_SITEMAP)))), date('c'));
  }
}