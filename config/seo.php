<?php
/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */

/* 網站的 seo 設定 */

  /* 主要的標題 */
  $_title       = "OA's blog";

  /* 網址 */
  $_url         = $_domain . $_git_name;

  /* 所屬者 */
  $_author      = '吳政賢(OA Wu)';

  /* 主要關鍵字 */
  $_keywords    = '吳政賢 | OA Wu | comdan66 | blog | php | javascript | jQuery | html | html | css | java';

  /* 主要敘述文字 */
  $_description = '紀錄生活、工作，這是一個屬於 OA 的個人部落格，內容皆屬於靜態 html 公開，版面也是自己實作切板，空間則是使用 github.io，如果對這 blog 技術有興趣的，非常歡迎到我 GitHub 參考囉！';

  /* Open Graph 相關設定 */
  $_og = array (
    'image' => $_url . '/img/og.png',
    'type' => 'profile',
    'locale' => 'zh_TW'
  );
