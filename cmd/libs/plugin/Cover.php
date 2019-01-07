<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

mb_regex_encoding('UTF-8');
mb_internal_encoding('UTF-8');
date_default_timezone_set('Asia/Taipei');

define('PATH_CMD_LIB_PLUGIN', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('PATH_CMD_LIB',        dirname(PATH_CMD_LIB_PLUGIN) . DIRECTORY_SEPARATOR);
define('PATH_CMD',            dirname(PATH_CMD_LIB) . DIRECTORY_SEPARATOR);
define('PATH',                dirname(PATH_CMD) . DIRECTORY_SEPARATOR);
define('DIRNAME',             basename(PATH));

define('PATH_SITEMAP',  PATH . 'sitemap'  . DIRECTORY_SEPARATOR);
define('PATH_MARKDOWN', PATH . 'markdown' . DIRECTORY_SEPARATOR);
define('PATH_TEMPLATE', PATH . 'template' . DIRECTORY_SEPARATOR);
define('PATH_ASSET',    PATH . 'asset'    . DIRECTORY_SEPARATOR);

define('MOVE_TO_ASSET', true);
define('CHECK_LINK_EXIST', true);
define('CHECK_IMAGE_EXIST', true);

include PATH_CMD_LIB_PLUGIN . 'Cover.Func.php';

try {
  
  $argv = argv(array_slice($argv, 1), [['-u', '--url']]);

  if (!($argv && array_key_exists('-u', $argv) && $argv['-u'] && ($url = rtrim(array_shift($argv['-u']), '/') . '/')))
    throw new Exception('請傳入參數 -u 或 --url，設定網址！');

  define('BASE_URL', $url);
  define('TITLE', "OA Wu's Blog");
  define('DESCRIPTION', "敘述");
  define('D4_IMG_URL', BASE_URL . 'img/d4.jpg');

  $dirs = [PATH_SITEMAP, PATH_ASSET];

  if ($errs = removeDirs($dirs))
    throw new Exception('以下其他目錄無法移除：' . implode(', ', $errs));

  if ($errs = mkdirDirs($dirs))
    throw new Exception('以下其他目錄無法建立：' . implode(', ', $errs));



  $menus = Menu::all();

  $itemsList = array_filter($menus, function($menu) {
    return $menu instanceof Items;
  });
  
  $dirs = array_map(function($menu) {
    return PATH . implode(DIRECTORY_SEPARATOR, $menu->uris()) . DIRECTORY_SEPARATOR;
  }, $itemsList);
  
  if ($errs = removeDirs($dirs))
    throw new Exception('以下其他目錄無法移除：' . implode(', ', $errs));

  if ($errs = removeRootFiles())
    throw new Exception('以下根目錄 html 無法移除：' . implode(', ', $errs));

  if ($errs = removeSingleItem(SingleItem::all()))
    throw new Exception('以下檔案無法移除：' . implode(', ', $errs));

  if ($errs = mkdirDirs($dirs))
    throw new Exception('以下其他目錄無法建立：' . implode(', ', $errs));

  if ($errs = writePages($itemsList))
    throw new Exception('以下列表 html 無法建立：' . implode(', ', $errs));

  if ($errs = writeItems(Item::all()))
    throw new Exception('以下 html 無法建立：' . implode(', ', $errs));

  if ($errs = writeSingleItem(SingleItem::all()))
    throw new Exception('以下檔案無法建立：' . implode(', ', $errs));

} catch (Exception $e) {
  echo $e->getMessage();
  exit(1);
}

exit(0);
