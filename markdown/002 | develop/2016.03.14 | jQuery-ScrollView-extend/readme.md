# 實作 jQuery ScrollView 套件

為了讓手機水平瀏覽圖片的操作更像 App 的介面，所以利用 [JavaScript](https://zh.wikipedia.org/zh-tw/JavaScript)、[jQuery](https://jquery.com/)、[jQuery-UI](https://jqueryui.com/)、[jQuery.UI.Touch-Punch](http://touchpunch.furf.com/) 等套件，實作 ScrollView 的水平滑動效果。

功能主要是依賴 jQuery 與 jquery-UI 實作，再利用 jQuery-UI 的 [Draggable](https://jqueryui.com/draggable/) 實作拖曳的效果，則 Draggable 需要設定 `axis: 'x'` 來固定水平拖曳移動。不過此時會發現手機的滑動時 Draggable 會失效，所以還需仰賴 jQuery.UI.Touch-Punch 修正！然後我再利用這些巨人大大的 library 作出這個 jQuery extend function！

### 特別注意

* 手機上實測好像還會頓頓的.. 還在調整中..
* Demo 頁面所有元素都是採用 `box-sizing: border-box;` 操作，所以要改的話，要稍微注意版型 [CSS](https://developer.mozilla.org/zh-TW/docs/Web/CSS) 部分。
* 因為是使用 [SCSS](http://sass-lang.com/) 撰寫，故此專案會有 SCSS、CSS 的資料夾。
* 目前最多容納 100 個水平元素！
* Demo 頁面中 [imgLiquid](https://github.com/karacas/imgLiquid) 只是讓我調整圖片的顯示，非主要功能！

### 相關參考
* [Live Demo](https://works.ioa.tw/OA-mobileScrollView/index.html)
* [GitHub 原始碼](https://github.com/comdan66/OA-mobileScrollView)
* [PTT Soft_Job](https://www.ptt.cc/bbs/Soft_Job/M.1457948370.A.BE9.html)
* [Facebook Front-End Developers Taiwan](https://www.facebook.com/groups/f2e.tw/permalink/960507037319995/)

`#jQuery` `#jQuery UI` `#ScrollView `