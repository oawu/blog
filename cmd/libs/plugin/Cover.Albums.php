<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2018, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Albums extends Items {
  const CHILD_CLASS = 'Album';

  public function write() {
    $tmp = PATH . ($this->uris ? implode(DIRECTORY_SEPARATOR, $this->uris) . DIRECTORY_SEPARATOR : ''). trim(Page::DIR_NAME, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    is_dir($tmp) || mkdir777($tmp);

    if (!(is_dir($tmp) && is_writeable($tmp)))
      return false;

    return !array_filter($this->pages(), function($page)  {
      return !fileWrite($page->writePath(), loadView(PATH_TEMPLATE . 'Albums.php', [
        '_header' => loadView(PATH_TEMPLATE . '_header.php'),
        '_menu' => loadView(PATH_TEMPLATE . '_menu.php', ['currentUrl' => $this->currentUrl()]),
        'page' => $page,
        'articles' => $this,
        '_info' => loadView(PATH_TEMPLATE . '_info.php'),
      ]));
    });
  }
}