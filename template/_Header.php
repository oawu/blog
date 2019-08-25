<?php

use function \HTML\Header as header;
use function \HTML\Div as div;
use function \HTML\A as a;
use function \HTML\B as b;
use function \HTML\Label as label;
use function \HTML\Span as span;
use function \HTML\Form as form;
use function \HTML\Input as input;
use function \HTML\Button as button;

echo header(
  div(
    isset($item) && ($page = $item->page())
      ? a()->id('backLink')->href($page->url())
      : null,

    label()->id('hamburger')->for('_menu'),

    a(
      b("OA's"),
      span('生活部落格'),
      span('Blog、Album'))->id('logo')->href(BASE_URL),

    form(
      input()->type('text')->id('q')->name('q')->placeholder('搜尋 OA Wu..')->value('')->pattern('.{1,}')->required(true)->title('搜尋'),
      button()->type('submit'))->id('headerSearch')->method('get')->action(Search::url()),

    label()->id('avatar')->for('_info')->url(OA_IMG_URL)))->id('header');
