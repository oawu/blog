### 說明
再來安裝一次 CodeIgniter、PHP-ActiveRecord，這篇之前有教過了，但這次我要講詳細一點點!  
因為網路上資源真的不多，可能很多東西還太新或者根本沒什麼人用吧^^  
不過我個人真的大力推薦 CodeIgniter 加上 PHP-ActiveRecord 來增強 Model 的功能！！

<br/>
### 規格
* OS - Windows 7
	- 請先安裝好 PHP 版本3以上!
	- 以及注意 php.ini 內的 php_pdo_mysql.dll 是要被啟用的

* CodeIgniter - CodeIgniter_2.1.4
	- [http://www.codeigniter.org.tw/](http://www.codeigniter.org.tw/)

* Spark Manager - spark-manager-0.0.9.zip
	- [http://getsparks.org/install](http://getsparks.org/install) (請用 Ctrl+F 搜尋 spark-manager )

* MY_Loader.php
   - [http://getsparks.org/install](http://getsparks.org/install) (請用 Ctrl+F 搜尋 MY_Loader.php ，下載後記得副檔名要改成 .php )

<br/>
### 步驟
如果你是 Mac OSX 系統的，就直接跳過這個章節！ 往[下一步](#Mac OSX)看吧！  
有了以上幾樣東西，就可以來製作一個有加上 PHP-ActiveRecord 的 CodeIgniter Framework 囉! [^1]

* 將 CodeIgniter_2.1.4.zip 解開壓縮，並且放置你的 Web Server 的根目錄(DocumentRoot)，然後將資料夾命名成 CodeIgniter

* 在 CodeIgniter 底下新增一個資料夾命名為 ***tools*** 並且將 ***spark-manager-0.0.9.zip*** 解壓縮至 ```./CodeIgniter/tools/``` 內，此時裡面要確認有 spark 這隻檔案! 沒有就不能進行下一步驟囉!

* 將 ***MY_Loader.php*** 放置 ```./application/core/``` 內。

* 使用管理員權限打開 ***cmd.exe*** 不會的話請自行 Google，首先移到 CodeIgniter 資料夾內，然後輸入指令 ```php tools\spark install -v0.0.2 php-activerecord``` 完後應該會發現 CodeIgniter 內多一個 ***sparks*** 的資料夾。
   
* 打開 ```./application/config/autoload.php``` 將 ```$autoload['libraries'] = array();``` 調整成 ```$autoload['libraries'] = array('database');```，在檔案最後面加上這一行 ```$autoload['sparks'] = array('php-activerecord/0.0.2');```。 
   
* 打開 ```./application/config/database.php```，請輸入你的資料庫 hostname、username、password、database 的值。

* 打開 ```./index.php``` 於 php 開頭加入 ```date_default_timezone_set('Asia/Taipei');``` 將系統時區設定成台北!

* 如果連線時出現資料庫 datetime 之類的問題，很有可能是因為 MySQL 版本太新，所以需要調整一下 ```./sparks/php-activerecord/0.0.2/vendor/php-activerecord/lib/Connection.php```， 將 ***datetime_to_string***、 ***string_to_datetime*** 這兩隻 Method 內的 ```'Y-m-d H:i:s T'``` 調整成 ```'Y-m-d H:i:s'```。

<br/>
### <a name='Mac OSX'></a>Mac OSX
這是因為 Windows 比較麻煩一點，如果是使用 OSX 或者 Linux 就簡單多了!  
OSX 或者 Linux 系統，只要下載 CodeIgniter_2.1.4.zip 後開啟終端機，並且到該 CodeIgniter 目錄下分別執行:

    php -r "$(curl -fsSL http://getsparks.org/go-sparks)"

    php tools\spark install -v0.0.2 php-activerecord

然後再執行以下步驟:

* 打開 ```./application/config/autoload.php``` 將 ```$autoload['libraries'] = array();``` 調整成 ```$autoload['libraries'] = array('database');```，在檔案最後面加上這一行 ```$autoload['sparks'] = array('php-activerecord/0.0.2');```。 
   
* 打開 ```./application/config/database.php```，請輸入你的資料庫 hostname、username、password、database 的值。

* 打開 ```./index.php``` 於 php 開頭加入 ```date_default_timezone_set('Asia/Taipei');``` 將系統時區設定成台北!

* 如果連線時出現資料庫 datetime 之類的問題，很有可能是因為 MySQL 版本太新，所以需要調整一下 ```./sparks/php-activerecord/0.0.2/vendor/php-activerecord/lib/Connection.php```， 將 ***datetime_to_string***、 ***string_to_datetime*** 這兩隻 Method 內的 ```'Y-m-d H:i:s T'``` 調整成 ```'Y-m-d H:i:s'```。



<br/>
### 小總結
以上步驟完後就完成了!! (這花了我一天研究 ((汗

Windows 基本上，我由重灌 Apache、MySQL、php 完後依照這些步驟，都沒問題，也可以寫 PHP-ActiveRecord 了! 至少用 Apache 版本 2.2.25-win32-x86-openssl-0.9.8y、MySQL 版本 community-5.6.13.0、php 版本 5.4.17-Win32-VC9-x86 沒問題的!

以上是我 CodeIgniter PHP-Activerecord 的經驗! 至少目前是OK的，至於如何使用...，可以參考官網 [CodeIgniter](http://www.codeigniter.org.tw/)、[PHP-ActiveRecord](http://www.phpactiverecord.org/)，以上 謝謝。

[^1]: 安裝步驟主要參考: [http://getsparks.org/install、http://getsparks.org/packages/php-activerecord/versions/HEAD/show](http://getsparks.org/install、http://getsparks.org/packages/php-activerecord/versions/HEAD/show)