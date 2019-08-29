<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Sitemap extends SingleItem {
  const SCHEMA = 'http://www.sitemaps.org/schemas/sitemap/0.9';
  const SCHEMA_IMAGE = 'http://www.google.com/schemas/sitemap-image/1.1';

  const OFFSET = 200;
  const SITEMAP_PATH = PATH_SITEMAP . 'sitemap_index.xml';
  const SITEMAP_URL  = BASE_URL . 'sitemap/sitemap_index.xml';

  protected static function uris() { return []; }
  protected static function format() { return 'xml'; }
  protected static function fileName() { return 'sitemap'; }
  
  private $fileName, $items = [], $type = 'article';
  public function __construct($fileName, $items, $type) {
    $this->fileName = $fileName;
    $this->items = $items;
    $this->type = $type;
  }


  public function newXml() {
    $path = PATH_SITEMAP . $this->fileName . '.xml';

    $xml = new XMLWriter();
    $xml->openURI($path);
    $xml->startDocument('1.0', 'UTF-8');
    $xml->setIndent(true);
    $xml->startElement('urlset');
    $xml->writeAttribute('xmlns', Sitemap::SCHEMA);
    return $xml;
  }

  public function endXml(XMLWriter $xml) {
    $xml->endDocument();
    return true;
  }

  public function writeArticleXml() {
    $xml = $this->newXml();
    
    foreach ($this->items as $item) {
      $xml->startElement('url');

      foreach ($item as $key => $value)
        if (in_array($key, ['loc', 'priority', 'changefreq', 'lastmod']))
          $xml->writeElement($key, $value);

      $xml->endElement();
    }

    return $this->endXml($xml);
  }

  public function writeAlbumXml() {
    $xml = $this->newXml();
    $xml->writeAttribute('xmlns:image', Sitemap::SCHEMA_IMAGE);

    foreach ($this->items as $item) {
      $xml->startElement('url');

      foreach ($item as $key => $value)
        if (in_array($key, ['loc', 'priority', 'changefreq', 'lastmod']))
          $xml->writeElement($key, $value);

      foreach ($item['images'] as $image) {
        $xml->startElement('image:image');

        foreach ($image as $key => $img)
          if (in_array($key, ['loc', 'caption', 'geo_location', 'title', 'license']))
            $xml->writeElement('image:' . $key, $img);

        $xml->endElement();
      }

      $xml->endElement();
    }

    return $this->endXml($xml);
  }

  public function writeSubXml() {
    $url = BASE_URL . 'sitemap/' . $this->fileName . '.xml';

    if (!($this->type == 'album' ? $this->writeAlbumXml() : $this->writeArticleXml()))
      return false;

    return $url;
  }

  public static function create($fileName, $items, $type) {
    return new static($fileName, $items, $type);
  }

  private static function writeXml($sitemaps) {
    foreach ([Sitemap::SITEMAP_PATH, static::writePath()] as $path) {
      $xml = new XMLWriter();
      $xml->openURI($path);
      $xml->startDocument('1.0', 'UTF-8');
      $xml->setIndent(true);
      $xml->startElement('sitemapindex');
      $xml->writeAttribute('xmlns', self::SCHEMA);

      $xml->startElement('sitemap');
      foreach ($sitemaps as $sitemap)
        $xml->writeElement('loc', $sitemap);

      $xml->writeElement('lastmod', date ('c'));
      $xml->endElement();

      $xml->endElement();
      $xml->endDocument();
    }
  }
  public static function write() {
    $sitemaps = [];

    for ($i = $j = 0, $c = count($articles = Item::sitemaps('article')), $t = strlen(ceil($c / Sitemap::OFFSET)); $i < $c; $i += Sitemap::OFFSET)
      $sitemaps[] = static::create('sitemap_' . sprintf('%0' . $t . 'd', $j++), array_slice($articles, $i, Sitemap::OFFSET), 'article');

    for ($i = $j = 0, $c = count($albums = Item::sitemaps('album')), $t = strlen(ceil($c / Sitemap::OFFSET)); $i < $c; $i += Sitemap::OFFSET)
      $sitemaps[] = static::create('sitemap_album_' . sprintf('%0' . $t . 'd', $j++), array_slice($albums, $i, Sitemap::OFFSET), 'album');

    self::writeXml(array_map(function($sitemap) {
      return $sitemap->writeSubXml();
    }, $sitemaps));

    return true;
  }
}