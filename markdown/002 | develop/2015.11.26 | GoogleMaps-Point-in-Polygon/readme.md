# 在 Google Maps 內多邊形取點 Point in Polygon

這是項個人開發的工具，而且需要前後端配合一起弄的作品，主要目的是撈出藉由不規則多邊形範圍內的點座標。

![Demo 動畫](img/001.gif)


### 前端
主要是 [Google Maps JavaScript API v3](https://developers.google.com/maps/documentation/javascript/?hl=zh-tw) 的地圖服務應用，利用 [Google Maps Marker](https://developers.google.com/maps/documentation/javascript/markers)、[Google Maps Polyline](https://developers.google.com/maps/documentation/javascript/examples/polyline-simple?hl=zh-tw) 去畫出一個不規則多邊形，並且利用 [Ajax](https://zh.wikipedia.org/wiki/AJAX) 去後端撈取範圍內的 Marker，當 Ajax 傳回後端之前，先將該多邊形角的座標點利用 [Google Maps LatLngBounds](https://developers.google.com/maps/documentation/javascript/reference) 物件計算出多邊形的範圍(**東北**-**西南**)座標，然後將範圍座標以及多邊形的角座標一併回傳給後端。

### 後端
使用 [CodeIgniter](https://codeigniter.org.tw/) 最簡單的寫法，當接收到 Ajax 的 Request 之後，便開始撈資料。撈取資料的步驟拆成兩個步驟，首先利用範圍座標的東北-西南座標進 MySQL 撈出範圍內的點，此時的點是一個矩形範圍，所以需要再進入第二項的 filter 利用公式將多邊形外的點過濾掉，最後 Output 回去給前端即可。

### 小結
此包專案使用原生 CodeIgniter 所撰寫，所以有基礎的 CodeIgniter framework know how 即可看懂。

* 前端 JavaScript 位置在：`assets/js/main.js`
* 後端 controller 位置在：`application/controllers/main.php`
* 後端**撈出範圍座標**的作法：`application/models/marker_model.php`
* 後端**計算多邊形**範圍內的 function：`application/helpers/main_helper.php`

※ 因系統維護關係，所以目前已暫時先將 Live Demo 網址關閉囉，請大家先參考 GitHub 的原始碼吧！

### 相關參考
* [GitHub 原始碼](https://github.com/comdan66/point-in-polygon)
* [PTT Soft_Job](https://www.ptt.cc/bbs/Soft_Job/M.1448600173.A.F75.html)
* [Facebook Front-End Developers Taiwan](https://www.facebook.com/groups/f2e.tw/permalink/912091015494931/)

`#Google Maps` `#JavaScript`