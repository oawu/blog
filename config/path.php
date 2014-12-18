<?php
/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */

// 靜態文章列表 存放位置
$_list = './articles';

// 靜態標籤文章列表 存放位置
$_tags = './tag';

// 靜態文章 存放位置
$_article = './article';

// 編輯文章 存放位置
$_mds = './mds';

// 版型 存放位置
$_templates = './templates';

// 各版型 路徑
$_template['list']['index']   = $_templates . DIRECTORY_SEPARATOR . 'list_index.html';
$_template['list']['view']    = $_templates . DIRECTORY_SEPARATOR . 'list.html';
$_template['tags']['index']    = $_templates . DIRECTORY_SEPARATOR . 'tags_index.html';
$_template['tags']['view']    = $_templates . DIRECTORY_SEPARATOR . 'tags.html';
$_template['article']['view'] = $_templates . DIRECTORY_SEPARATOR . 'article.html';

$_template['main']['index'] = $_templates . DIRECTORY_SEPARATOR . 'main_index.html';