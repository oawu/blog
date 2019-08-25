<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

define('PATH_CMD_LIB_PLUGIN_COVER', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('PATH_CMD_LIB_PLUGIN',       dirname(PATH_CMD_LIB_PLUGIN_COVER) . DIRECTORY_SEPARATOR);
define('PATH_CMD_LIB',              dirname(PATH_CMD_LIB_PLUGIN) . DIRECTORY_SEPARATOR);
define('PATH_CMD',                  dirname(PATH_CMD_LIB) . DIRECTORY_SEPARATOR);
define('PATH',                      dirname(PATH_CMD) . DIRECTORY_SEPARATOR);
define('DIRNAME',                   basename(PATH));
define('PATH_DIST',                 PATH . 'dist' . DIRECTORY_SEPARATOR);

define('PATH_MARKDOWN', PATH . 'markdown' . DIRECTORY_SEPARATOR);
define('PATH_TEMPLATE', PATH . 'template' . DIRECTORY_SEPARATOR);

define('PATH_SITEMAP',  PATH_DIST . 'sitemap'  . DIRECTORY_SEPARATOR);


define('PATH_IMG',  PATH . 'img'  . DIRECTORY_SEPARATOR);
define('PATH_CSS',  PATH . 'css'  . DIRECTORY_SEPARATOR);
define('PATH_JS',   PATH  . 'js'  . DIRECTORY_SEPARATOR);
define('PATH_FONT', PATH  . 'font'  . DIRECTORY_SEPARATOR);

define('PATH_DIST_IMG',  PATH_DIST . 'img'  . DIRECTORY_SEPARATOR);
define('PATH_DIST_CSS',  PATH_DIST . 'css'  . DIRECTORY_SEPARATOR);
define('PATH_DIST_JS',   PATH_DIST  . 'js'  . DIRECTORY_SEPARATOR);
define('PATH_DIST_FONT', PATH_DIST  . 'font'  . DIRECTORY_SEPARATOR);
