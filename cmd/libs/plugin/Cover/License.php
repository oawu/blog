<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class License extends SingleItem {
  private static $article = null;

  protected static function init() {
    static::$article = Article::init(PATH_MARKDOWN . static::id() . ' | ' . static::fileName() . DIRECTORY_SEPARATOR, static::fileName(), [], null);
  }

  protected static function id() { return '010'; }
  protected static function uris() { return []; }
  protected static function format() { return 'html'; }
  protected static function fileName() { return 'license'; }

  public static function write() {
    return fileWrite(static::writePath(), loadView(PATH_TEMPLATE . 'License.php', [
      '_Checkbox' => loadView(PATH_TEMPLATE . '_Checkbox.php'),
      '_Header' => loadView(PATH_TEMPLATE . '_Header.php'),
      '_Menu' => loadView(PATH_TEMPLATE . '_Menu.php'),
      '_Info' => loadView(PATH_TEMPLATE . '_Info.php'),
      'article' => static::$article,
    ]));
  }
}