<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2018, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class ArticleIndex extends Article {
  public function writeHtml() {
    return fileWrite($this->htmlPath(), loadView(PATH_TEMPLATE . 'ArticleIndex.php', [
      '_header' => loadView(PATH_TEMPLATE . '_header.php'),
      '_menu' => loadView(PATH_TEMPLATE . '_menu.php', ['currentUrl' => $this->currentUrl()]),
      'article' => $this,
      '_info' => loadView(PATH_TEMPLATE . '_info.php'),
    ]));
  }
}