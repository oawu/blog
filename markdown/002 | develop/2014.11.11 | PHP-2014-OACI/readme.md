# 2014 OACI

這是一個以 [CodeIgniter 2.1.4](https://ellislab.com/codeigniter/user-guide/installation/downloads.html) 為基礎版本，將其新增進階功能的一套好用的 [PHP](https://zh.wikipedia.org/wiki/PHP) Framework，加入了 [PHP ActiveRecord](http://www.phpactiverecord.org/) 並且與 OrmUploader 讓圖片網址處理更方便，以及多樣的前後端整併。

這一套個人的 Framework 如入了多樣的資源參考，其中參考了 [Ruby on Rails](http://rubyonrails.org/) 的 [RubyGems](https://rubygems.org/) 相關工具，以及導入 [OA's ElasticSearch](../2015.08.26 | PHP-ElasticSearch-PDO/readme.md) 工具，並且與前端工具 [Compass](http://compass-style.org/)、[Gulp](http://gulpjs.com/) 做結合、加入多樣的常用函式，最重要的加入了 PHP 指令的管理，例如 Create、Delete、Migration.. 等管理指令。

[GitHub](https://github.com/comdan66/oaci#%E5%B8%B8%E7%94%A8%E6%8C%87%E4%BB%A4) 上的 Readme 有初步的簡介這套 Framework 幾項主要功能，並且實作範例，讓使用者能順利了解。

以下是 [Youtube](https://www.youtube.com/) 簡單 Demo 初始化使用基本 CRUD 的流程：

<iframe allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/svomGfqxZvg"></iframe>


### 以下是目前幾項主要功能：

* 匯入並且使用 PHP ActiveRecord ORM，並且可以與 OrmUploader 搭配結合。
* 匯入使用 OrmUploader 的 Library，此功能設計主要參考 Ruby on Rails 上 RubyGems 的 [carrierwave](https://github.com/carrierwaveuploader/carrierwave) 套件，可搭配 ORM 使用 ImageUplader、FileUploader 處理上傳表單，其中 ImageUplader 更可配合使用 ImageGdUtility、ImageImagickUtility 針對圖片做壓縮處理。
* 匯入使用 [Redis](http://redis.io/) Cache Library。
* 匯入使用 cell 的 Library，此功能主要參考 Ruby on Rails 上 RubyGems 的 [cells](https://github.com/apotonick/cells) 所設計，並且加強有層級結構關係、暫存快取機制、導入可使用 Redis Cache。
* 加強 CodeIgniter 原生 Config 機制，讓原本取得 Config 做成快取並且將 File Cache 的 Folder 的重新定義向下延伸分類資料夾。
* 匯入可記錄 Delay Request 的 Log 以及 ORM Query Log。
* 匯入並且可使用 Compass、Scss、Gulp。
* 匯入 [OA-ElasticSearch](../2015.08.26 | PHP-ElasticSearch-PDO/readme.md) 加入 [ElasticSearch](https://www.elastic.co/) 的使用以及相關管理指令。

### 相關參考
* [Youtube 影片](https://www.youtube.com/watch?&v=svomGfqxZvg)
* [GitHub 原始碼](https://github.com/comdan66/oaci)
* [PHP ActiveRecord](http://www.phpactiverecord.org/)
* [PHP ActiveRecord GitHub](https://github.com/jpfuentes2/php-activerecord)

`#PHP` `#ElasticSearch ` `#Redis` `#PHP ActiveRecord`