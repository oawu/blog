<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, LaliloCore
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

namespace HTML;

echo html(
  head(
    meta()->attr('http-equiv', 'Content-Language')->content('zh-tw'),
    meta()->attr('http-equiv', 'Content-type')->content('text/html; charset=utf-8'),
    meta()->name('viewport')->content('width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui'),

    title(TITLE),

    asset()
      ->css('https://cdn.jsdelivr.net/npm/hack-font@3.3.0/build/web/hack.css')
      ->css('icon.css')
      ->css('core.css')
      ->css('dev/jquery-pokemon-game.css')

      ->js('https://code.jquery.com/jquery-1.12.4.min.js')
      ->js('https://cdn.jsdelivr.net/npm/vue@2.6.11/dist/vue.min.js')

      ->js('core.js')
      ->js('el.js')
      ->js('dev/jquery-pokemon-game.js')
  ),
  body()
)->lang('zh-Hant');
