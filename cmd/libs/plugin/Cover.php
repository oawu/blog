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

include __DIR__ . DIRECTORY_SEPARATOR . '_' . DIRECTORY_SEPARATOR . 'core.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'Cover' . DIRECTORY_SEPARATOR . '_Define.php';
include PATH_CMD_LIB_PLUGIN_COVER . '_Func.php';
include PATH_CMD_LIB_PLUGIN_COVER . 'HTML.php';

$sTime = microtime(true);

$argv = argv(array_slice($argv, 1), [['-u', '--url']]);

if (!($argv && array_key_exists('-u', $argv) && $argv['-u'] && ($url = rtrim(array_shift($argv['-u']), '/') . '/')))
  throw new PluginException('請傳入參數 -u 或 --url，設定網址！');

define('BASE_URL', $url);
include PATH_CMD_LIB_PLUGIN_COVER . '_Define2.php';

if (cleanDist(PATH_DIST))
  throw new PluginException('清除 Dist 目錄發生錯誤！');

if ($errs = cloneDirs([PATH_IMG => PATH_DIST_IMG, PATH_CSS => PATH_DIST_CSS, PATH_JS => PATH_DIST_JS, PATH_FONT => PATH_DIST_FONT]))
  throw new PluginException('以下其他目錄無法複製：' . implode(', ', arrayFlatten($errs)));

$menus = Menu::all();

$itemsList = array_filter($menus, function($menu) {
  return $menu instanceof Items;
});

$dirs = array_merge(array_map(function($menu) {
  return PATH_DIST . implode(DIRECTORY_SEPARATOR, $menu->uris()) . DIRECTORY_SEPARATOR;
}, $itemsList), [PATH_SITEMAP]);

if ($errs = mkdirDirs($dirs))
  throw new PluginException('以下其他目錄無法建立：' . implode(', ', $errs));

if ($errs = writePages($itemsList))
  throw new PluginException('以下列表 html 無法建立：' . implode(', ', $errs));

if ($errs = writeItems(Item::all()))
  throw new PluginException('以下 html 無法建立：' . implode(', ', $errs));

if ($errs = writeSingleItem(SingleItem::all()))
  throw new PluginException('以下檔案無法建立：' . implode(', ', $errs));
