<?php

use function \HTML\Div as div;
use function \HTML\A as a;
use function \HTML\Label as label;
use function \HTML\Span as span;

$links = [
  ['class' => 'icon-11', 'href' => 'https://www.facebook.com/comdan66',       'title' => 'Facebook',   'text' => '吳政賢'],
  ['class' => 'icon-10', 'href' => 'https://www.cakeresume.com/comdan66',     'title' => 'CakeResume', 'text' => '個人簡歷'],
  ['class' => 'icon-12', 'href' => 'https://github.com/comdan66',             'title' => 'GitHub',     'text' => 'OA Wu'],
  ['class' => 'icon-13', 'href' => 'https://www.facebook.com/LiveCoding.tw/', 'title' => '粉絲專頁',     'text' => 'LiveCoding.tw'],
];

echo div(array_map(function($link) {
  return a(
    span($link['text'])->title($link['title']))->class($link['class'])->target('_blank')->href($link['href']); }, $links))->id('info')->class('n' . count($links));

echo label()->class('cover')->for('_info');
