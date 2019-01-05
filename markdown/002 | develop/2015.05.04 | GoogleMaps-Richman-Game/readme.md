# Google Maps 大富翁

這是一個使用 [Google Maps JavaScript API](https://developers.google.com/maps/documentation/javascript/?hl=zh-tw) 製作的大富翁遊戲！基本上是利用 Google Maps Markers 以及 Polyline 所建置出路線、節點、角色、計分、蓋房... 等設計！

這是一個使用前端 [JavaScript](https://zh.wikipedia.org/zh-tw/JavaScript)、[Google Maps](https://www.google.com.tw/maps) 所設計的[大富翁遊戲](https://zh.wikipedia.org/wiki/%E5%A4%A7%E5%AF%8C%E7%BF%81%E7%B3%BB%E5%88%97)，主要也使用了 [jQuery](https://jquery.com/) 以及 [SCSS](http://sass-lang.com/) 等工具實作，利用 [Google Maps Marker](https://developers.google.com/maps/documentation/javascript/markers)、[Polyline](https://developers.google.com/maps/documentation/javascript/examples/polyline-simple?hl=zh-tw) 去做設計，繪製出路線、人物。

此版本加入與電腦對戰的設計，遇到的困難是當兩個角色(Marker)落於同一個點時，必須要做位置的調整，房屋座落點的位置計算兩線的外角，之後可能進階改版成線上多人對戰，並且可以使用道具遊戲..等功能。

前端版型，主要是用 [Compass](http://compass-style.org/) 撰寫 SCSS 以協助 [CSS](https://developer.mozilla.org/zh-TW/docs/Web/CSS) 的切版，JavaScript 的部分則是使用 jQuery 加強跨瀏覽器的語法之援度問題。

### 相關參考
* [Live Demo](https://works.ioa.tw/OA-richman/index.html)
* [GitHub 原始碼](https://github.com/comdan66/OA-richman)
* [PTT Soft_Job](https://www.ptt.cc/bbs/Soft_Job/M.1431526940.A.7B1.html)
* [Facebook Front-End Developers Taiwan](https://www.facebook.com/groups/f2e.tw/permalink/830618616975505/)

`#Google Maps` `JavaScript`