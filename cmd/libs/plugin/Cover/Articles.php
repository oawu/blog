<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Articles extends Items {
  const CHILD_CLASS = 'Article';

  public function write() {
    $tmp = PATH_DIST . ($this->uris ? implode(DIRECTORY_SEPARATOR, $this->uris) . DIRECTORY_SEPARATOR : ''). trim(Page::DIR_NAME, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    is_dir($tmp) || mkdir777($tmp);

    if (!(is_dir($tmp) && is_writeable($tmp)))
      return false;

    return !array_filter($this->pages(), function($page)  {
      return !fileWrite($page->writePath(), loadView(PATH_TEMPLATE . 'Articles.php', [
        '_Checkbox' => loadView(PATH_TEMPLATE . '_Checkbox.php'),
        '_Header' => loadView(PATH_TEMPLATE . '_Header.php'),
        '_Menu' => loadView(PATH_TEMPLATE . '_Menu.php', ['currentUrl' => $this->currentUrl()]),
        '_Info' => loadView(PATH_TEMPLATE . '_Info.php'),
        'page' => $page,
        'articles' => $this,
      ]));
    });
  }
}