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
use function \HTML\Span as span;
use function \HTML\A as a;
use function \HTML\B as b;
use function \HTML\Figure as figure;
use function \HTML\Img as img;
use function \HTML\Figcaption as figcaption;
use function \HTML\Article as article;
use function \HTML\Section as section;
use function \HTML\Header as header;
use function \HTML\H1 as h1;
use function \HTML\Time as time;

$jsonLd1 = [
  '@context' => 'http://schema.org',
  '@type' => 'Person',
  'email' => 'mailto:comdan66@gmail.com',
  'image' => OA_IMG_URL,
  'jobTitle' => '資深網站工程師',
  'name' => '吳政賢(OA Wu)',
  'alumniOf' => '淡江大學',
  'birthPlace' => '台灣省 嘉義市',
  'birthDate' => '1989.07.21',
  'height' => '67.5 inches',
  'gender' => 'male',
  'memberOf' => 'male',
  'nationality' => 'Republic of China',
  'url' => $article->url(),
  'sameAs' => [
    'https://www.ioa.tw/',
    'https://www.facebook.com/comdan66',
    'https://github.com/comdan66',
    'https://www.cakeresume.com/comdan66',
    'https://www.youtube.com/user/comdan66',
    'https://www.facebook.com/LiveCoding.tw/',
    'https://plus.google.com/u/0/+吳政賢',
    'https://picasaweb.google.com/108708350604082729522',
    'https://www.flickr.com/comdan66',
    'https://www.linkedin.com/in/政賢-吳-116136a1']];

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
    figure(
      img()->src($article->ogImage),
      figcaption($article->description ? $article->description : $article->title))->id('articleCover')->url($article->ogImage),
    article(
      header(
        h1($article->title)->data('sub', 'OA Wu'),
        span($article->bio),
        figure(
          img()->src($article->iconImage))->url($article->iconImage)),
      section($article->content)->class('markdown'),
      div(array_map(function($tag) {
        return a($tag)->href(Search::url() . '?q=' . $tag); }, $article->tags))->class('tags'),
      time($article->updateAt->format('Y-m-d 00:00:00'))->editdate('editdate')->date($article->updateAt->format('Y.m.d'))->datetime($article->updateAt->format('Y-m-d 00:00:00')))->id('indexArticle')->class('panel'),
    div(array_map(function($other) {
      return a(
        div()->class($other->className()),
        b($other->text()),
        span($other->subText()))->href($other->url()); }, $article->others()))->id('other'),
    div(
      div()->class('fb-comments')->width('100%')->data('order-by', 'reverse_time')->data('href', $article->url())->data('numposts', 5))->id('comments')->class('panel')))->id('main');

echo html(
  head(
    meta()->attr('http-equiv', 'Content-Language')->content('zh-tw'),
    meta()->attr('http-equiv', 'Content-type')    ->content('text/html; charset=utf-8'),
    meta()->name('viewport')                      ->content('width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui'),
    meta()->name('google-site-verification')      ->content(GOOGLE_SITE_VERIFICATION),
    meta()->name('robots')                        ->content('index,follow'),
    meta()->name('keywords')                      ->content(KEYWORDS),
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
