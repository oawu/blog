# 實作台北 • 藝文活動

這是項利用[新北市政府資料開放平台](http://data.ntpc.gov.tw/)提供的[新北市政府文化局藝文活動](http://data.ntpc.gov.tw/od/detail?oid=781B822E-214A-4B9A-B4DB-32C9F4626D98) API 所製作的台北 • 藝文活動。使用 [PHP](https://zh.wikipedia.org/zh-tw/PHP) 將 API 資料取下來後編輯成 [HTML](https://zh.wikipedia.org/zh-tw/HTML) 頁面，並且放置到 [Amazon S3](https://aws.amazon.com/tw/s3/)。放置部署過程中同時將頁面所需的 [SCSS](https://zh.wikipedia.org/wiki/%E5%B1%82%E5%8F%A0%E6%A0%B7%E5%BC%8F%E8%A1%A8)、[JavaScript](https://zh.wikipedia.org/wiki/JavaScript) 一起上傳至 S3。

上傳 S3 過程採用 PHP 執行，關鍵程式碼在[這裡](https://github.com/comdan66/taipei_activities/blob/master/cmd/put.php)，主要是利用 S3 針對檔案都有 tag 的特性，對上傳檔案做 [md5_file](http://php.net/manual/en/function.md5-file.php)，達成差異化更新的步驟！

### 步驟
* 取得 S3 上所有檔案
* 整理準備上傳的檔案
* 比對準備上傳與 S3 上檔案的 md5_file 差異
* 針對差異做更新、刪除、上傳

![使用 php 將 API 資料取下來後編輯成 HTML 頁面，並且放置到 Amazon S3。放置部署過程中同時將頁面所需的 css、JavaScript，並且一起上傳至 S3](img/001.jpg)

網頁排版盡量參照 [Material Design](https://material.google.com/)，同時具有[響應式網頁設計（RWD）](http://www.ibest.tw/page01.php)的版型，讓手機用戶也可以方便瀏覽與輕鬆操作。切版使用 [Compass](http://compass-style.org/) 編譯 [SCSS](http://sass-lang.com/)，頁面上使用 JavaScript 完成互動功能，如：快速搜尋，利用 jQuery 的 [selector](https://api.jquery.com/category/selectors/) `[name*="value"]` 完成模糊搜尋，並且利用網址的 [Hash](http://www.w3schools.com/jsref/prop_loc_hash.asp) 來做分類查詢。

依據資料開放平台上表示每天會更新，所以系統排程會在每日上午 6 時去取得最新的藝文活動資訊，並且放置到 s3 上做更新。目前只爬取新北市政府的開放資料，未來會補上台北市的部分，若是有發現其他縣市的活動 API，也會一併整理起來。

若是覺得不錯，可以對 [GitHub](https://github.com/comdan66/taipei_activities) 按個星星，鼓勵一下作者吧：）

### 相關參考
* [GitHub 原始碼](https://github.com/comdan66/taipei_activities)
* [新北市政府資料開放平台](http://data.ntpc.gov.tw/)
* [新北市政府文化局藝文活動](http://data.ntpc.gov.tw/od/detail?oid=781B822E-214A-4B9A-B4DB-32C9F4626D98)
* [PTT Soft_Job](https://www.ptt.cc/bbs/Soft_Job/M.1467160346.A.EE9.html)
* [Facebook Front-End Developers Taiwan](https://www.facebook.com/groups/f2e.tw/permalink/1020671314636900/)

`#PHP` `#jQuery` `#開方資料` `#新北市`