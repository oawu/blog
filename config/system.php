<?php
/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */

/* Build.php 相關程式設定 */

  /* Domain name，結尾記得加 斜線 */
  $_domain = 'http://comdan66.github.io/';

  /* Git Repository 名稱 */
  $_git_name = 'OA-blog';

  /* 靜態文章列表 存放位置 */
  $_list = './articles';

  /* 靜態標籤文章列表 存放位置 */
  $_tags = './tag';

  /* 靜態文章 存放位置 */
  $_article = './article';

  /* 編輯文章 存放位置 */
  $_mds = './markdowns';

  /* 版型 存放位置 */
  $_templates = './templates';

  /* 存放 sitemap 的位置 */
  $_sitemap  = './sitemap';

  /* 存放 sitemap 的網址 */
  $_sitemap_url  = $_domain . '/' . $_git_name . '/' . preg_replace ('#(^\.\/)#', '', $_sitemap) . '/' . 'sitemap_index.xml';

  /* 各版型 路徑 */
  $_template = array (
    'list' => array (
      'index' => $_templates . DIRECTORY_SEPARATOR . 'list_index.html',
      'view' => $_templates . DIRECTORY_SEPARATOR . 'list.html'
    ),
    'tags' => array (
      'index' => $_templates . DIRECTORY_SEPARATOR . 'tags_index.html',
      'view' => $_templates . DIRECTORY_SEPARATOR . 'tags.html'
    ),
    'article' => array (
      'view' => $_templates . DIRECTORY_SEPARATOR . 'article.html'
    ),
    'main' => array (
      'index' => $_templates . DIRECTORY_SEPARATOR . 'main_index.html'
    ),
    'seo' => array (
      'robots' => $_templates . DIRECTORY_SEPARATOR . 'robots.html'
    )
  );

  /* 編輯轉靜態 讀取選擇，.html or .md */
  $_format = '.html';

  /* 輸出靜態頁面的格式 */
  $_oput_format = '.html';

  /* 標簽檔案名稱 */
  $_tags_file_name = 'tags.txt';

