<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Pagination {
  const LR_COUNT = 2;
  const FIRST_CLASS  = 'pp';
  const PREV_CLASS   = 'p';
  const ACTIVE_CLASS = 'a';
  const NEXT_CLASS   = 'n';
  const LAST_CLASS   = 'nn';

  public static function create(Page $page, $pages) {
    $total = count($pages);
    
    if ($total < 2)
      return '';

    $links = $prev = $first = $next = $last = [];

    for ($i = 0, $c = count($pages); $i < $c; $i++)
      if ($pages[$i]->index() == $page->index()) {
        
        for ($j = $i - 1, $k = Pagination::LR_COUNT; $j >= 0 && $k > 0 && ($tmp = ['href' => $pages[$j]->url(), 'text' => $pages[$j]->index() + 1, 'class' => null]); $j--, $k--)
          array_unshift($links, !$prev ? $prev = $tmp : $tmp);
        
        array_push($links, ['href' => $pages[$i]->url(), 'text' => $pages[$i]->index() + 1, 'class' => Pagination::ACTIVE_CLASS]);
        
        for(++$i, $k = Pagination::LR_COUNT; $i < $c && $k > 0 && ($tmp = ['href' => $pages[$i]->url(), 'text' => $pages[$i]->index() + 1, 'class' => null]); $i++, $k--)
          array_push($links, !$next ? $next = $tmp : $tmp);

        break;
      }

    $links && $pages && $links[0]['href'] != $pages[0]->url() && $first = ['href' => $pages[0]->url(), 'text' => '', 'class' => Pagination::FIRST_CLASS];
    $links && $pages && $links[count($links) - 1]['href'] != $pages[$c = count($pages) - 1]->url() && $last = ['href' => $pages[$c]->url(), 'text' => '', 'class' => Pagination::LAST_CLASS];

    $prev  && ($prev['class'] = Pagination::PREV_CLASS) && !($prev['text'] = '') && array_unshift($links, $prev);
    $first && array_unshift($links, $first);
    $next  && ($next['class'] = Pagination::NEXT_CLASS) && !($next['text'] = '') && array_push($links, $next);
    $last  && array_push($links, $last);

    return implode('', array_map(function($link) {
      return '<a' . attr($link, ['text']) . '>' . $link['text'] . '</a>';
    }, $links));
  }
}