# Welcome To OA's blog!
這是一個 OA's Blog。

---
## 聲明
本作品只限分享於研究、研討性質之使用，並不提供任何有營利效益之使用。
如有營利用途，務必告知作者 [OA](http://www.ioa.tw/) (<comdan66@gmail.com>)，並且經由作者同意。


<br/>
## 簡介
* 利用 [GitHub Pages](https://pages.github.com/) 建立個人部落格。
* 適用於 Mac os 並且可使用 apache、php 指令為前提條件。
* 輕鬆建立出 html 靜態頁面的部落格。
* 可調整屬於個人的相關資料。
* 此功能也可以放置於 [Dropbox](https://www.dropbox.com/) 的 public 資料夾。

<br/>
## Demo
* Youtube Sample
<a href="https://www.youtube.com/watch?&v=pUBWKUEb7Do" target="_blank"><img width='50%' src="http://img.youtube.com/vi/pUBWKUEb7Do/0.jpg" alt="OA's Blog youtube demo!" /></a>

* OA's Blog GitHub Pages
Demo: [http://comdan66.github.io/blog/](http://comdan66.github.io/blog/)



<br/>
## 使用
1. 開啟終端機，並且位置移至 apache DocumentRoot 下。
2. 輸入指令 ```git clone https://github.com/comdan66/blog.git```
2. 進入 blog，輸入指令 ```cd blog```
3. Check out 到 gh-pages 分支下，輸入指令 ```git checkout gh-pages```
4. 調整資料夾權限設定，輸入指令 ```chmod 777 .```
5. 新增、編輯、刪除 部落格(markdowns)內容。
6. 執行 php 編譯出靜態頁面，輸入指令 ```php build.php```
7. Push 至 [GitHub Pages](https://pages.github.com/)

> **<span style="color: red">注意！</span>** 若是從 [blog](https://github.com/comdan66/blog) clone 下來的 Repository，請在 push 之前請先改成自己的 github！


<br/>
## 解說
一般設定皆在 ```./config/``` 目錄下，以下分別解說個檔案主要功能設定。

### owner.php
網站上、右、下方的資訊內容

* $_nav_items - 網站上方的導航 bar
* $_pins - 網站右方的 widget
* $_footer - 網站下方的資訊

> **<span style="color: red">注意！</span>** 若不想顯示，只要將 array 中的一項 element 移除或 隱藏即可。

### seo.php
網站的 seo 設定

* $_title - 主要的標題
* $_url - 網址
* $_author - 所屬者
* $_keywords - 主要關鍵字
* $_description - 主要敘述文字
* $_og - Open Graph 相關設定

> **<span style="color: red">注意！</span>** 這邊只是大致的 meta value 設定，若要更詳細可直接在 templates 內設定。

### setting.php
網站基本設定

* $_a_page_limit - 列表一頁多少個預覽
* $_is_show_next - 分頁是否顯示 下一頁
* $_is_show_prev - 分頁是否顯示 上一頁
* $_pagination_limit - 分頁顯示數量，0 則不限制
* $_list_preview_length - 列表 文章預覽長度
* $_list_more - 列表 閱讀更多文字

### system.php
Build.php 相關程式設定

* $_domain - Domain name，結尾記得加 斜線
* $_git_name - Git Repository 名稱
* $_list - 靜態文章列表 存放位置
* $_tags - 靜態標籤文章列表 存放位置
* $_article - 靜態文章 存放位置
* $_mds - 編輯文章 存放位置
* $_templates - 版型 存放位置
* $_sitemap - 存放 sitemap 的位置
* $_sitemap_url - 存放 sitemap 的網址
* $_template - 各版型 路徑
* $_format - 編輯轉靜態 讀取選擇，.html or .md
* $_oput_format - 輸出靜態頁面的格式
* $_tags_file_name - 標簽檔案名稱

> **<span style="color: red">注意！</span>** 此檔案內皆為重要性的設定，若不熟悉者請勿恣意更改。

<br/>
## 關於
* 作者名稱 - [OA Wu](http://www.ioa.tw/)

* E-mail - <comdan66@gmail.com>

* 作品名稱 - blog

* GitHub - [blog](https://github.com/comdan66/blog)

* 更新日期 - 2014/12/21