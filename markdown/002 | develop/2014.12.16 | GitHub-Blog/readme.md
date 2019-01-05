# 用 GitHub 架設 Blog

使用 [GitHub](https://github.com/) 架設個人 Blog 不僅可以節省伺服器空間，同時也可以使用 Markdown 語法做文章管理，坊間也有很多類似的工具 [octopress](http://octopress.org/)、[pelican](http://www.pelican.com/)，但是最後決定自己做一套使用 [PHP](http://www.pelican.com/)、以及 command line 建置出個人的部落格！

看到這標題我想板上很多大大們可能會覺的市面上已經很多資源了，沒想到還有人自己刻，而我也是寫完分享給朋友，才知道已經有人做過，不過既然刻了，就分享一下！

首先，目的是為了利用 GitHub 所提供的 [GitHub.io](https://pages.github.com/) 以及 Branch gh-pages 建置出靜態的網站，所以必須利用 php 去將 .md 的 Markdown 文件轉成 .html 的靜態文件，並且加入 **標簽**、**分頁** 等功能！

所以說，整個系統基本上就是利用 php 指令執行 build.php 這隻檔案，編譯出這些 html 靜態頁面，而在編譯時利用 `lib/oa/helper.php` 內的 **load_view** function，可以使用 `templates/` 內的版型匯出 html，最後也會產生 sitmap、robots.txt 加強 SEO 搜尋排行曝光度。若有用過 [CodeIgniter](https://codeigniter.org.tw/) 的話，應該就會很熟悉 load_view 的用法！

如果想要將他變成自己的 Blog 的話，在 GitHub 上有一個名為 [pure](https://github.com/comdan66/blog/tree/pure) 的 Branch，裡面就是一個乾淨的版本，可以直接修改 `config/` 內的設定檔，不過記得修改完後，要再用 `php build.php` 重新建立靜態頁，完成後也可以放置於 Dropbox 的 public 資料夾使用。

Youtube 教學影片如下：

<iframe allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/pUBWKUEb7Do"></iframe>

※ 因系統維護關係，所以目前已暫時先將 Live Demo 網址關閉囉，請大家先參考 GitHub 的原始碼吧！

### 相關參考
* [GitHub 原始碼](https://github.com/comdan66/blog)
* [Youtube 影片](https://www.youtube.com/watch?v=pUBWKUEb7Do)
* [PTT Soft_Job](https://www.ptt.cc/bbs/Soft_Job/M.1419438051.A.B58.html)

`#GitHub` `#Blog`