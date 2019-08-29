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
use function \HTML\Header as header;
use function \HTML\Label as label;
use function \HTML\H1 as h1;
use function \HTML\A as a;
use function \HTML\B as b;
use function \HTML\P as p;

$main = main(
  div(
    div(
      b(),
      header(
        h1(404),
        span('頁面好像不見惹')),
      p('此頁面似乎消失了..'),
      p('建議您回', a('首頁')->href(BASE_URL), '，或者', label('搜尋')->for('q'), '一下吧！'))->id('p404')))->id('main');

echo html(
  head(
    meta()->attr('http-equiv', 'Content-Language')->content('zh-tw'),
    meta()->attr('http-equiv', 'Content-type')    ->content('text/html; charset=utf-8'),
    meta()->name('viewport')                      ->content('width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui'),
    meta()->name('google-site-verification')      ->content(GOOGLE_SITE_VERIFICATION),
    meta()->name('robots')                        ->content('noindex,nofollow'),
    title('404 Not Found' . SEPARATE . TITLE),
    link()->type('text/css')->rel('stylesheet')->href(BASE_URL . 'css/icon.css'),
    link()->type('text/css')->rel('stylesheet')->href(BASE_URL . 'css/public.css'),
    script()->type('text/javascript')->language('javascript')->src(BASE_URL . 'js/jquery-1.12.4.min.js'),
    script()->type('text/javascript')->language('javascript')->src(BASE_URL . 'js/public.js'),
    script('$(function() { var url = "' . BASE_URL . '?f=404' . '"; if (window.location.pathname.slice(-1) == "/") url = "' . BASE_URL . '" + window.location.pathname.slice(1) + "index.html"; else if (window.location.pathname.slice(-16) == "index/index.html") url = "' . BASE_URL . '?f=404' . '"; else if (window.location.pathname.slice(-5) != ".html") url =  "' . BASE_URL . '" + window.location.pathname.slice(1) + ".html"; else if (window.location.pathname.slice(-5) == ".html") url = "' . BASE_URL . '" + window.location.pathname.slice(1, -5) + "/index.html"; else url = "' . BASE_URL . '?f=404' . '";  var $q = $("#q"), timer = null; $q.focus(function() { clearTimeout(timer); }); if (url != "' . BASE_URL . '?f=404' . '") window.location.replace(url); else timer = setTimeout(function() { window.location.replace(url); }, 7.5 * 1000); });')->type('text/javascript')->language('javascript')
  ),
  body(
    $_Checkbox,
    $_Header,
    $_Menu,
    $main,
    $_Info,
    div()->id('fb-root')
  )
)->lang('zh-Hant');
