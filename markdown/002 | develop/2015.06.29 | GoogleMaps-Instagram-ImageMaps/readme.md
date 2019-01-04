# 實作 Instagram Maps 相片地圖

[Instagram](https://www.instagram.com/) App 當中有一項很特別的功能是我很喜愛的，就是地圖模式的瀏覽照片，而且 Instagram 將這項功能優化得不錯，使得當地圖縮小時，密集的 Marker 會合成一個 Marker，而這樣的地圖功能在 [Google Maps JavaScript API](https://developers.google.com/maps/documentation/javascript/?hl=zh-tw) 上可以實作得到！

簡單說，這個專案的目的是利用 Google Mpas 來模擬實作出 Instagram 地圖照片模式！基本上會使用 Google Maps API、[MarkerClusterer](https://googlemaps.github.io/js-marker-clusterer/docs/examples.html)、[MarkerWithLabel](http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerwithlabel/)。

架構是當我移動地圖畫面時，會先利用 [Google Maps LatLngBounds](https://developers.google.com/maps/documentation/javascript/reference) 物件計算出多邊形的範圍(東北-西南)座標，然後再將範圍座標的經緯度使用 [AJAX](https://zh.wikipedia.org/zh-tw/AJAX) 傳至後端，後端則依據範圍座標撈出範圍內的所有點，並且輸出 [Json](http://www.json.org/) 格式的資訊給前端 JavaScript 接收處理，前端取得資料後接著利用 MarkerWithLabel 來顯示照片，最後當地圖縮放時，則是利用 MarkerClusterer 將太密集的點縮成一個集合！

※ 因系統維護關係，所以目前已暫時先將 Live Demo 網址關閉囉，請大家先參考 GitHub 的原始碼吧！

### 相關參考
* [GitHub 原始碼](https://github.com/comdan66/OA-instagram_maps)
* [PTT Soft_Job](https://www.ptt.cc/bbs/Soft_Job/M.1435556584.A.709.html)
* [Facebook Front-End Developers Taiwan](https://www.facebook.com/groups/f2e.tw/permalink/853973294640037/)

`#Google Maps` `#JavaScript` `#Instagram `