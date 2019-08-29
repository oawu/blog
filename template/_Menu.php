<?php

use function \HTML\Header as header;
use function \HTML\Div as div;
use function \HTML\A as a;
use function \HTML\Label as label;
use function \HTML\Span as span;
use function \HTML\Footer as footer;

$currentUrl = isset($currentUrl) ? $currentUrl : null;

echo div(
  header(
    div("OA's"),
    div('生活部落格'))->id('menuHeader'),

  array_map(function($menu) use ($currentUrl) {
    return a($menu->text())->href($menu->url())->class($menu->className() . ($currentUrl === $menu->url() ? ' a' : ''))->data('cnt', $menu instanceof Items ? count($menu->items()) : null); }, Menu::all()),

  footer(
    a('服務條款 - 授權聲明')->href(License::url()),
    span('©2014 - ' . date('Y') . ' WWW.IOA.TW'))->id('menuFooter'))->id('menu');

echo label()->class('cover')->for('_menu');
