# PHP 實作 ElasticSearch PDO 物件

這是一套 [ElasticSearch](https://www.elastic.co/) 基本 [Create、Read、Update、Delete(CRUD)](https://zh.wikipedia.org/wiki/%E8%B3%87%E6%96%99%E6%93%8D%E7%B8%B1%E8%AA%9E%E8%A8%80) 的使用工具，其工具主要目的就是將資料撈出來並且物件化，架構於 [Elastic Library](https://github.com/ruflin/Elastica)，將讀取出來的資料物件化，以及包裝成方便開發的工具。

主要功能是經由各種 **類別方法(static)**，對 ElasticSearch 實作 **新增**、**查詢**、**修改**、**刪除** 的操作，並且將查詢出來的每一筆資料，再將其封裝成物件單位，每筆物件皆可繼承基礎的 修改、刪除 的實體方法，更可以對分別不同 Type 做出不同的類別(Class)，方便於物件化思維的設計。

以下是基本的說明：

* 這是一套架構於 [Elastic Library](https://github.com/ruflin/Elastica) 所開發的工具，進階方便使用物件操作 ElasticaSearch 資料讀取。
* 經由各種類別方法(static)，對 Elastica Search 實作[新增](https://works.ioa.tw/OA-ElasticaSearch/guide/create.html)、[查詢](https://works.ioa.tw/OA-ElasticaSearch/guide/read.html)、[修改](https://works.ioa.tw/OA-ElasticaSearch/guide/update.html)、[刪除](https://works.ioa.tw/OA-ElasticaSearch/guide/delete.html)的操作。
* 查詢出來的每一筆資料，再將其封裝成物件單位，方便於物件化思維的設計。
* 每筆物件皆可繼承基礎的 修改、刪除 的 **實體方法**。
* 分別對不同 Type 分類出不同的類別(Class)。
* 使用前要先引入 `demo/Elastica/ElasticaSearch.php` 檔案後即可使用。
* CRUD 範例，將會以 Type User 作為範例說明，詳細結構可以查閱[結構說明](https://works.ioa.tw/OA-ElasticaSearch/guide/struct.html)。
* 後端 PHP 語言範例可以查閱檔案 `demo/index.php`。
* 相關 Elastica Search 語法可以查閱 [https://www.elastic.co/](https://www.elastic.co/)。

### 相關參考
* [Live Demo](https://works.ioa.tw/OA-ElasticaSearch/index.html)
* [GitHub 原始碼](https://github.com/comdan66/OA-ElasticaSearch)
* [PTT PHP](https://www.ptt.cc/bbs/PHP/M.1440735206.A.FC7.html)
* [PTT Soft_Job](https://www.ptt.cc/bbs/Soft_Job/M.1440735487.A.4C1.html)
* [Facebook PHP 台灣](https://www.facebook.com/groups/199493136812961/permalink/850647258364209/)
* [Facebook Backend 台灣 (Backend Tw)](https://www.facebook.com/groups/616369245163622/permalink/725753477558531/)
* [Facebook Front-End Developers Taiwan](https://www.facebook.com/groups/f2e.tw/permalink/877530442284322/)

`#PHP` `#ElasticSearch`