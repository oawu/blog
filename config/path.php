<?php

// 靜態文章列表 存放位置
$_list = './list';

// 靜態文章 存放位置
$_article = './article';

// 編輯文章 存放位置
$_mds = './mds';

// 版型 存放位置
$_models = './models';

// 各版型 路徑
$_model['list']['index']   = $_models . DIRECTORY_SEPARATOR . 'list_index.html';
$_model['list']['view']    = $_models . DIRECTORY_SEPARATOR . 'list.html';
$_model['article']['view'] = $_models . DIRECTORY_SEPARATOR . 'article.html';