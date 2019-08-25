<?php

use function \HTML\Html as html;
use function \HTML\Head as head;
use function \HTML\Body as body;
use function \HTML\Meta as meta;
use function \HTML\Title as title;
use function \HTML\Link as link;
use function \HTML\Script as script;
use function \HTML\Main as main;
use function \HTML\Div as div;

$jsonLd1 = [
  '@context' => 'http://schema.org', 
  '@type' => 'WebSite', 
  'url' => BASE_URL, 
  'potentialAction' => [
    '@type' => 'SearchAction',
    'target' => BASE_URL . 'search.html?q={keyword}&referrer=jsonLd_searchbox',
    'query-input' => 'required name=keyword']];

$jsonLd2 = [
  '@context' => 'http://schema.org',
  '@type' => 'BreadcrumbList',
  'itemListElement' => $scopes = array_values(array_filter([
    ['@type' => 'ListItem', 'position' => 1, 'item' => ['@id' => BASE_URL, 'name' => TITLE, 'url' => BASE_URL] ],
    ['@type' => 'ListItem', 'position' => 2, 'item' => ['@id' => Search::url(), 'name' => '搜尋結果', 'url' => Search::url()] ],
  ]))];

$main = main(
  div()->id('search')->data('api', AllJson::url()))->id('main');

echo html(
  head(
    meta()->attr('http-equiv', 'Content-Language')->content('zh-tw'),
    meta()->attr('http-equiv', 'Content-type')    ->content('text/html; charset=utf-8'),
    meta()->name('viewport')                      ->content('width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui'),
    meta()->name('google-site-verification')      ->content(GOOGLE_SITE_VERIFICATION),
    meta()->name('robots')                        ->content('index,follow'),
    meta()->name('keywords')                      ->content(KEYWORDS),
    meta()->name('description')                   ->content(mb_strimwidth(removeHtmlTag(str_replace('"', "'", DESCRIPTION)), 0, 120, '…','UTF-8')),
    meta()->property('og:url')                    ->content(Search::url()),
    meta()->property('og:title')                  ->content('搜尋結果' . SEPARATE . TITLE),
    meta()->property('og:description')            ->content(mb_strimwidth(removeHtmlTag(str_replace('"', "'", DESCRIPTION)), 0, 200, '…','UTF-8')),
    meta()->property('og:site_name')              ->content(TITLE),
    meta()->property('fb:admins')                 ->content('100000100541088'),
    meta()->property('fb:app_id')                 ->content('1033322433418965'),
    meta()->property('og:locale')                 ->content('zh_TW'),
    meta()->property('og:type')                   ->content('article'),
    meta()->property('article:author')            ->content('https://www.facebook.com/comdan66'),
    meta()->property('article:publisher')         ->content('https://www.facebook.com/comdan66'),
    meta()->property('article:modified_time')     ->content(date('c')),
    meta()->property('article:published_time')    ->content(date('c')),
    meta()->property('og:image')                  ->content(OG_IMG_URL),
    meta()->property('og:image:type')             ->content(typeOfImg(OG_IMG_URL)),
    meta()->property('og:image:width')            ->content(1200),
    meta()->property('og:image:height')           ->content(630),
    title('搜尋結果' . SEPARATE . TITLE),
    link()->rel('canonical')->href(Search::url()),
    link()->rel('alternate')->href(Search::url())->hreflang('zh-Hant'),
    link()->type('text/css')->rel('stylesheet')->href(BASE_URL . 'css/icon.css'),
    link()->type('text/css')->rel('stylesheet')->href(BASE_URL . 'css/public.css'),
    script()->type('text/javascript')->language('javascript')->src(BASE_URL . 'js/jquery-1.12.4.min.js'),
    script()->type('text/javascript')->language('javascript')->src(BASE_URL . 'js/public.js'),
    script(json_encode($jsonLd1, JSON_UNESCAPED_SLASHES))->type('application/ld+json'),
    script(json_encode($jsonLd2, JSON_UNESCAPED_SLASHES))->type('application/ld+json')
  ),
  body(
    $_Checkbox,
    $_Header,
    $_Menu,
    $main,
    $_Info,
    scope($scopes),
    div()->id('fb-root')
  )
)->lang('zh-Hant');
