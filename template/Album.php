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
use function \HTML\Article as article;
use function \HTML\Figure as figure;
use function \HTML\Img as img;
use function \HTML\Figcaption as figcaption;
use function \HTML\Header as header;
use function \HTML\H1 as h1;
use function \HTML\Span as span;
use function \HTML\Section as section;
use function \HTML\Time as time;

$jsonLd1 = [
  '@context' => 'http://schema.org', 
  '@type' => 'Article',
  'url' => $article->url(),
  'headline' => $article->title,
  'image' => $article->ogImage,
  'datePublished' => $article->createAt->format('c'),
  'dateModified' => $article->updateAt->format('c'),
  'author' => [
    '@type' => 'Person',
    'name' => '吳政賢(OA Wu)',
    'url' => BASE_URL,
    'image' => [
      '@type' => 'ImageObject',
      'url' => OA_IMG_URL
    ]
  ],
  'publisher' => [  
    '@type' => 'Organization',
    'name' => TITLE,
    'logo' => [  
      '@type' => 'ImageObject',
      'url' => LOGO_IMG_URL,
    ]
  ],
  'description' => $article->description,
  'dateCreated' => $article->createAt->format('c'),
  'dateModified' => $article->updateAt->format('c'),
  'alternativeHeadline' => TITLE,
  'keywords' => implode(' ', $article->tags), 
  'genre' => $article->items() ? $article->items()->text() : TITLE, 
  'articleBody' => removeHtmlTag($article->content),
  'mainEntityOfPage' => [
    '@type' => 'WebPage',
    '@id' => $article->url()]];

$jsonLd2 = [
  '@context' => 'http://schema.org',
  '@type' => 'BreadcrumbList',
  'itemListElement' => $scopes = array_values(array_filter([
      ['@type' => 'ListItem', 'position' => 1, 'item' => ['@id' => BASE_URL, 'name' => TITLE, 'url' => BASE_URL] ],
      $article->items() ? ['@type' => 'ListItem', 'position' => 2, 'item' => ['@id' => $article->items()->url(), 'name' => $article->items()->text(), 'url' => $article->items()->url()] ] : null,
      ['@type' => 'ListItem', 'position' => $article->items() ? 3 : 2, 'item' => ['@id' => $article->url(), 'name' => $article->title, 'url' => $article->url()] ]
    ]))];

$main = main(
  div(
    div(
      article(
        figure(
          img()->alt(($article->title ? $article->title . SEPARATE : '') . TITLE)->src($article->ogImage),
          figcaption(($article->title ? $article->title . SEPARATE : '') . TITLE))->url($article->ogImage),
        header(
          h1($article->title),
          span(str_replace('-', ' ', $article->fileName()))),
        section($article->content)->class('markdown'),
        time($article->updateAt->format('Y-m-d 00:00:00'))->editdate('editdate')->date($article->updateAt->format('Y.m.d'))->datetime($article->updateAt->format('Y-m-d 00:00:00')))->id('albumCover'),
      div(array_map(function($image) use ($article) {
        return figure(
          img()->alt(($image['alt'] ? $item['alt'] . SEPARATE : '') . $article->title)->src($image['src']),
          figcaption($image['alt'] ? $item['alt'] : $article->title))->data('bgurl', $image['src'])->class($image['class'])->url($image['src']); }, $article->images))->id('pics') )->class('album')))->id('main');

echo html(
  head(
    meta()->attr('http-equiv', 'Content-Language')->content('zh-tw'),
    meta()->attr('http-equiv', 'Content-type')    ->content('text/html; charset=utf-8'),
    meta()->name('viewport')                      ->content('width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui'),
    meta()->name('google-site-verification')      ->content(GOOGLE_SITE_VERIFICATION),
    meta()->name('robots')                        ->content('index,follow'),
    meta()->name('keywords')                      ->content($article->tags ? implode(', ', $article->tags) : KEYWORDS),
    meta()->name('description')                   ->content(mb_strimwidth(str_replace('"', "'", $article->description), 0, 120, '…','UTF-8')),
    meta()->property('og:url')                    ->content($article->url()),
    meta()->property('og:title')                  ->content(($article->title ? $article->title . SEPARATE : '') . TITLE),
    meta()->property('og:description')            ->content(mb_strimwidth(str_replace('"', "'", $article->description), 0, 200, '…','UTF-8')),
    meta()->property('og:site_name')              ->content(TITLE),
    meta()->property('fb:admins')                 ->content('100000100541088'),
    meta()->property('fb:app_id')                 ->content('1033322433418965'),
    meta()->property('og:locale')                 ->content('zh_TW'),
    meta()->property('og:type')                   ->content('article'),
    meta()->property('article:author')            ->content('https://www.facebook.com/comdan66'),
    meta()->property('article:publisher')         ->content('https://www.facebook.com/comdan66'),
    meta()->property('article:modified_time')     ->content($article->createAt->format('c')),
    meta()->property('article:published_time')    ->content($article->updateAt->format('c')),
    meta()->property('og:image')                  ->content($article->ogImage),
    meta()->property('og:image:type')             ->content(typeOfImg($article->ogImage)),
    meta()->property('og:image:width')            ->content(1200),
    meta()->property('og:image:height')           ->content(630),
    
    title(($article->title ? $article->title . SEPARATE : '') . TITLE),
    
    link()->rel('canonical')->href($article->url()),
    link()->rel('alternate')->href($article->url())->hreflang('zh-Hant'),
    link()->type('text/css')->rel('stylesheet')->href(BASE_URL . 'css/icon.css'),
    link()->type('text/css')->rel('stylesheet')->href(BASE_URL . 'css/oaips.css'),
    link()->type('text/css')->rel('stylesheet')->href(BASE_URL . 'css/public.css'),
    
    script()->type('text/javascript')->language('javascript')->src(BASE_URL . 'js/jquery-1.12.4.min.js'),
    script()->type('text/javascript')->language('javascript')->src(BASE_URL . 'js/oaips.js'),
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
