# 歐芙娜 OFNA

這是一個前、後、系統端技術的外包案實作，其網站名稱為[歐芙娜 OFNA](http://www.ofna-bio.com/)，此專案主要負責前端刻板、後端串接、系統端部署部份，版型設計則由[宙思設計](https://www.zeusdesign.com.tw/)所製作。

此專案是常見的官網實作，主要由後台的上稿系統挑選完稿後，前台即可顯示所編輯的資料，而前端部分有常見的 Banner 輪播、資訊列表、聯絡我們功能！後端 php 框架是使用 [OACI](https://github.com/comdan66/oaci) [version 1.7](https://github.com/comdan66/oaci/tree/version/1.7) 所實作，前端則使用搭配框架上的 [Compass](http://compass-style.org/) 來編輯 [SCSS](http://sass-lang.com/)。

多國語系的設計是此專案的一項功能，而在網址上則是使用同一個 URL，其作法是使用 Session/Cookie 來記錄所選擇的語系，當使用者選擇網頁上的語系時，則設定 [Session](https://en.wikipedia.org/wiki/Session_(web_analytics))/[Cookie](https://en.wikipedia.org/wiki/HTTP_cookie)，當後端框架載入 Controller 時，再取出 Session/Cookie 決定語系，取得語系後再導入不同的 View 即可做到此效果。

### 相關參考
* [Live Demo](http://www.ofna-bio.com/)
* [GitHub 原始碼](https://github.com/comdan66/ofna)

`#接案`