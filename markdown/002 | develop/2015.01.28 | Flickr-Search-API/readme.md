# 實作 Flickr API 搜尋器

這是一個簡單快速搜尋 Flickr 的前端工具，借由輸入想搜尋的圖片關鍵字而撈取出 Flickr 上面的熱門照片！

專案內利用了 [Flickr API](https://www.flickr.com/services/api/) 製作，作品中 JavaScrip 經由 Flickr Tag API 撈出符合關鍵字的照片集，然後再利用瀑布流套件 [Masonry](http://masonry.desandro.com/) 完成瀑布流效果的搜尋結果。

使用方式如下：

* 於網頁上方的 **搜尋列** 輸入欲搜尋的圖片 **關鍵字**。
* 多組關鍵字可用 **空白鍵**、**逗號**(,) 隔開，ex: ptt,正妹。
* 關鍵字輸入完畢後，按下 Enter鍵 或按下 **搜尋按鈕** 即可。

### 相關參考
* [Live Demo](https://works.ioa.tw/flickr/index.html)
* [GitHub 原始碼](https://github.com/comdan66/flickr)

`#Flickr`