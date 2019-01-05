# 實作 Google Maps 右鍵選單

此作品主要在於開發出可以在 Google Maps 上面編輯基本路徑的功能，利用 [Google Maps JavaScript API](https://developers.google.com/maps/documentation/javascript/?hl=zh-tw) 設計出規劃路線的工具，並且可以匯出路間經緯度 [Excel](https://products.office.com/zh-tw/excel)。

在 Google Maps 上顯示選單，主要是使用 [Google Maps JavaScript Events](https://developers.google.com/maps/documentation/javascript/events?hl=zh-tw) 來實作，並且搭配 [Marker](https://developers.google.com/maps/documentation/javascript/markers)、[Polyline](https://developers.google.com/maps/documentation/javascript/examples/polyline-simple?hl=zh-tw) 來繪製出路線圖，並且針對 Marker 綁定 Event 來實作 **刪除節點** 的功能。

此實作中有一項特別的技巧，就是在 Ployline 上點擊滑鼠右鍵時，必須要可以 插入節點 的功能，難點是在於 Maps 上的 [Google Maps Position](https://developers.google.com/maps/documentation/javascript/examples/control-positioning?hl=zh-tw) 與 [Google Maps Point](https://developers.google.com/maps/documentation/javascript/examples/icon-complex) 物件的[轉換](https://github.com/comdan66/OA-googleMapsMenu/blob/master/js/public.js#L51)，必須將點擊位置的經緯度經計算後得知在地圖元素上相對應的 left、top 數值，再將選單顯示在該位置上。

因為要針對不同區段的 Polyline 監聽 Event，所以必須使用特別的方式去畫出 Polyline，目前我所使用的方法是將 Markers 之間用單個 Polyline 做連接，所以地圖上 Polyline 的數量會是 Marker 的 n-1 個，如此一來就可以對每段 Polyline 監聽 Event 了！

當插入節點時，便可以取出該 Polyline 是位於哪兩個 Markers 之間，這時候再針對陣列去做橋接，重組後的 Markers 陣列再重新繪製一次 Polyline 即可！

### 相關參考
* [Live Demo](https://works.ioa.tw/OA-googleMapsMenu/index.html)
* [GitHub 原始碼](https://github.com/comdan66/OA-googleMapsMenu)

`#Google Maps` `#JavaScript`