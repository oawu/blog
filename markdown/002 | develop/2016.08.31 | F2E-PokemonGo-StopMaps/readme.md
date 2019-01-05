# Pokémon Go 補給站地圖

這是一個 Pokémon Go 進化後 CP 推測工具，可以快速查詢寶可夢進化後的 CP 範圍值，同時藉由網友互助回報而建立的全台寶可夢巢穴位置，讓大家可以查詢各精靈在台灣的分佈，若大家想要共同編輯[巢穴文件](https://docs.google.com/spreadsheets/d/1fMYgcbQV0haZcoKTdUYZaoorKaFCl8cFIF0aD4KDpHM/edit#gid=0)可與網站作者聯絡，同時也可以查詢全台灣的補給站、道館的[分佈](https://works.ioa.tw/evolution/stops.html)。

若要進一步的查詢各精靈的精準數值的話，可以使用 PokeIV小助手 來協助管理、計算數值，PokeIV小助手 不僅可以查詢個體值(IV)外，還可以設定快速進化、估算進化值.. 等功能，PokeIV小助手 同時也修改了被官網軟鎖得疑慮，經不同演算法大大減低風險！

巢穴地圖的 Google 文件轉化成地圖呈現亦是使用之前實作的 [Google 試算表取得 API](../2016.09.06 | GoogleSheets-API) 的方式，藉由 [JavaScript](https://zh.wikipedia.org/zh-tw/JavaScript) 的 [AJAX](https://zh.wikipedia.org/zh-tw/AJAX) 去取得試算表上的經緯度資訊，再呈現到 [Google Maps](https://maps.google.com.tw/) 上。

### 實作說明
* 使用 [PTT PokeMon](https://www.ptt.cc/bbs/PokeMon/index.html) 版文章 - [菜鳥致新手: CP、等級、IV、...](https://www.ptt.cc/bbs/PokeMon/M.1470508630.A.DF6.html) 提及的公式演算。
* CP 公式：(種族攻擊力 + 個體攻擊力) ×(種族防禦值 + 個體防禦值)^0.5 × (種族體力值 + 個體體力值)^0.5 × (等級換算值)^2 ÷ 10。
* 由於網頁版不能知曉個體數值，故利用最小 0，與最大 15 計算。
* 估算方式是藉由比率計算，故等級換算值會被互相約分除去，所以有無等級換算值不影響結果。
* 因不知道個體數值，所以只能推算大約結果，而數值也僅供參考喔！不過藉由我自己實測結果，都有落在範圍值內。
* 範圍公式：(進化前CP * 進化前最小CP) / 進化前最小CP 與 (進化前CP * 進化前最大CP) / 進化前最大CP。
* [巢穴地圖](https://works.ioa.tw/evolution/maps.html) 是使用各位網友回報的數據實作的，所以不是 100% 會出現的，一切僅供參考。
* [巢穴地圖](https://works.ioa.tw/evolution/maps.html) 的數據目前放置在 [Google 文件](https://docs.google.com/spreadsheets/d/1fMYgcbQV0haZcoKTdUYZaoorKaFCl8cFIF0aD4KDpHM/edit#gid=0) 上，藉由 Pokémon Go 同好玩家們共同編輯。
* 若想共同編輯[巢穴地圖 Google 文件](https://docs.google.com/spreadsheets/d/1fMYgcbQV0haZcoKTdUYZaoorKaFCl8cFIF0aD4KDpHM/edit#gid=0) 的話，歡迎與[我](http://www.ioa.tw/)聯絡，亦或者發 [E-Mail](comdan66@gmail.com) 給他！
* 網頁上的查詢都是 HTML、JavaScript 前端檔案處理，所以後端並不會存取任何使用者的查詢資料喔！
* [補給站、道館分佈地圖](https://works.ioa.tw/evolution/stops.html)，是我、小編們踏遍全台灣收集校正的！若是各位大大們想引用的話，請標註出處 [Go Evolution！](https://works.ioa.tw/evolution/index.html)

### 相關參考
* [Live Demo](https://works.ioa.tw/evolution/index.html)
* [GitHub 原始碼](https://github.com/comdan66/evolution/)
* [PTT Soft_Job](https://www.ptt.cc/bbs/Soft_Job/M.1470650059.A.EC4.html)
* [PTT PokeMon](https://www.ptt.cc/bbs/PokeMon/M.1472793302.A.9F0.html)
* [PTT PokeMonGo 1](https://www.ptt.cc/bbs/PokemonGO/M.1472805252.A.2A0.html)
* [PTT PokeMonGo 2](https://www.ptt.cc/bbs/PokemonGO/M.1475147103.A.B01.html)
* [PTT PokeMonGo 3](https://www.ptt.cc/bbs/PokemonGO/M.1475738122.A.064.html)
* [Facebook Front-End Developers Taiwan](https://www.facebook.com/groups/f2e.tw/permalink/1064416303595734/)
* [藍色小惡魔 - 抓寶人生: 大家找寶貝失..](https://pokeimp.blogspot.tw/2016/10/blog-post.html)

`#Pokémon` `#Google Maps` `#jQuery`