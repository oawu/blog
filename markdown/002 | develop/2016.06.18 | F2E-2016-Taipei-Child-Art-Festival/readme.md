# 2016 新北兒藝節

這是一個前端技術的外包案實作，其網站名稱為 [2016 新北市兒童藝術節](http://www.ntpc-childartfestival.com.tw/)，主要就是承接新北市 2016 年兒童藝術節的活動官網。此活動網站最具特色的地方是動畫的呈現，大家可以先點至 [GitHub Demo](https://sasachu.github.io/2016child/) 瀏覽動畫效果喔！

動畫是整個網站的主軸功能，在與 2015 年的兒藝節官網不同的地方是，以往是大量使用 [jQuery Animate](http://api.jquery.com/animate/) 的功能，而 2016 年則是使用 [CSS3](https://www.w3schools.com/css/css3_intro.asp) 的 [Animation](http://www.w3schools.com/css/css3_animations.asp) 來呈現出動畫效果，藉由不同的時間差，依序的控制動畫，[jQuery](https://jquery.com/) 則是扮演著次要功能，例如：skip。

會使用 CSS3 來實作動畫，主要是考量到前端網頁效能的問題，比起使用 jQuery 來實作，CSS 更能讓畫面流暢許多，專案開發過程中使用 [SCSS](http://sass-lang.com/) 來開發，並且使用 [Compass](http://compass-style.org/) 來編譯成 CSS，使開發前端專案事半功倍！

### 相關參考
* [Live Demo](http://www.ntpc-childartfestival.com.tw/)
* [GitHub Demo](https://sasachu.github.io/2016child/)
* [GitHub 原始碼](https://github.com/SaSaChu/2016child)
* [2015 新北兒藝節](http://www.jackie-imc.com/2015newtaipeicitycaf/)

`#接案` `jQuery` `CSS` `Animation `