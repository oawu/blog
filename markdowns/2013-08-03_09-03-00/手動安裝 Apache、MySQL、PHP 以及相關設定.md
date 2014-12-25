### 說明
這次要講解比較多一點的 Apache+MySQL+PHP 了，先定義好我這次用的軟體，哥這次我不再用 [Appserv](http://www.appservnetwork.com/)[^1] 了，就是因為他都沒再更新，昨天才解 Bug 到天亮..  

這次回味一下當年大三自己剛學 PHP 時，一步步按部就班的安裝，以下有幾個檔案要大家自行到他們官網下載，至於版本人家當然會一直更新，這就要看各位要不要用跟我一樣的版本囉^^


<br/>
### 規格
* OS，版本: Windows 7，並且先調整至**顯示副檔名**，不會的自行 Google!

* Apache，版本: httpd-2.2.25-win32-x86-openssl-0.9.8y.msi
	- [http://httpd.apache.org/download.cgi](http://httpd.apache.org/download.cgi)
   
* MySQL，版本: mysql-installer-community-5.6.13.0.msi
	- [http://dev.mysql.com/downloads/installer/5.6.html](http://dev.mysql.com/downloads/installer/5.6.html)

* PHP，版本: php-5.4.17-Win32-VC9-x86.zip，這邊請下載Thread Safe[^2]
	- [http://windows.php.net/download/#php-5.4](http://windows.php.net/download/#php-5.4)

* phpMyAdmin，版本: phpMyAdmin-4.0.4.2-all-languages.7z
	- [http://www.phpmyadmin.net/home_page/index.php](http://www.phpmyadmin.net/home_page/index.php)
   

<br/>
### 步驟
其實 Google 上面就可以找到一堆資訊了啦，但各位可以參考這篇: [http://blog.roodo.com/esabear/archives/15069653.html](http://blog.roodo.com/esabear/archives/15069653.html)[^3]

1. 首先第一個要安裝的是 Apache，這個倒沒什麼難度，只要點兩下 **httpd-2.2.25-win32-x86-openssl-0.9.8y.msi** 即可，跟一般軟體差不多，只要跟著步驟下一步就可，中間會有一點點比較特別的是要你填寫 ip 的東西，填完然後繼續下一步!安裝類型我會選擇 **典型(Typical)**，完成安裝後，可以打開瀏覽器，然後網址打上 [http://127.0.0.1](http://127.0.0.1) 就可以看到結果囉^^
   
2. 再來安裝 MySQL，一樣點擊兩下 **mysql-installer-community-5.6.13.0.msi** 即可開始安裝，基本上這個版本途中沒什麼大問題，如果有不懂的英文單字就 Google 一下就可以囉，中間會有一個要你選擇 **Developer Machine**、**Server Machine**、**Dedicated MySQL**，其分別代表 **開發用主機**、**使用最少記憶體**、**伺服器用主機**、**使用中等記憶體**、**資料庫專用主機**、**使用最大記憶體**，我是選擇 Server Machine，再來則會有一個要輸入密碼的地方，這個密碼就是你資料庫的root權限密碼，再來就差不多完成 MySQL 的安裝了!
   
3. 接著安裝 PHP，這傢伙最麻煩，搞了我一整個下午!!! 首先看你想把他安裝在哪裡，然後在那邊新增資料夾並且命名之! 我舉個例子好了(之後下面皆用此例講解)，假設我要安裝在我的 ```C:/Program Files (x86)/``` 下的話，我**就在 Program Files (x86) 下面新增一個資料夾命名成 PHP**，接著將 php-5.4.17-Win32-VC9-x86.zip 內容全部解開至此! 這時候 PHP 資料夾內會有很多個檔案，找出一支叫做 **php.ini-production** 的檔案，將它重新命名成 **php.ini**，然後找一下有沒有一隻檔案叫做 **php5apache2_2.dll**，沒有的話，就不能下一步囉^^!!!!
   
4. 然後到 Apache 的目錄下，找到 ```conf/httpd.conf``` 這隻檔案，並且用筆記本或其他文字編譯器打開它，在 **LoadModule** 之前加入這行 ```PHPIniDir "C:/Program Files (x86)/PHP"```[^4]，接著在 LoadModule 之後加入這行 ```LoadModule php5_module "C:/Program Files (x86)/PHP/php5apache2_2.dll"``` 所以我才說 php5apache2_2.dll 很重要，然後在 ***<IfModule mime_module>*** 下方加入這行 ```AddHandler application/x-httpd-php .php``` 即可，接著在 ***<IfModule dir_module>*** 裡面的 ***DirectoryIndex index.html*** 改成 ```DirectoryIndex index.html index.php``` 就OK囉~
   
5. 這時候重新開啟 Apache 後就可以在你的 ***DocumentRoot***[^5] 內編寫一個 .php 檔案，秀一下 phpinfo(); 囉!

6. 以為完成了嘛!? 錯! 這時候你的 PHP 還不能與 MySQL 完美合體，所以繼續! 到 PHP 資料夾內用文字編譯器打開 ***php.ini***，搜尋 ```extension_dir = "ext"```，將他改成 ```extension_dir = "C:/Program Files (x86)/PHP/ext"```，接著搜尋 ```;extension``` 就可以發現到有很多的 extension 目前是被註解掉的! 看你需要哪些就把 ;extension 前面的分號拿掉[^6]，然後搜尋 ```display_errors = Off``` 如果有找到的話，麻煩請改成 ```display_errors = On```，要不然 Error Message 每次都要到 ```./logs/error.log``` 看..
   
7. 以上完成後一樣重新啟動 Apache，完成以上後 Apache、php、MySQL 都差不多完美結合了，你可以在用一次 phpinfo(); 看看! 再來將 ***phpMyAdmin-4.0.4.2-all-languages.7z*** 解開壓縮後，放置到你的 ***DocumentRoot*** 目錄下，然後將其資料夾命名成 phpMyAdmin，然後在 phpMyAdmin 裡面新增一個名為 ***config*** 的資料夾，然後用瀏覽器輸入網址 [http://127.0.0.1/phpMyAdmin/setup](http://127.0.0.1/phpMyAdmin/setup) 就可以設定 phpMyAdmin 囉! 設定好之後你再到 ```./phpMyAdmin/config/``` 裡面看，會有多出一個檔案 ***config.inc.php*** 如果沒有 ***儲存更改設定*** 的話就不會有這隻檔案喔，不過我通常少會把語言調成繁體中文以及一些編碼方式，只要將 ```./phpMyAdmin/config/config.inc.php``` 搬移至 ```./phpMyAdmin/``` 下，這樣每次開啟 phpMyAdmin 就不用又再次調整囉^^


<br/>
### 小筆記
#### phpMyAdmin
* 調整登出時間，於檔案 ```./phpMyAdmin/config.inc.php``` 最後加入:
	
	```
	ini_set("session.gc_maxlifetime", 3600 * 24 * 365);
	$cfg['LoginCookieValidity'] = 3600 * 24 * 365;
```

#### php.ini
* 當錯誤時是否在頁面顯示錯誤訊息
	* 顯示: ```display_errors = On```(設置值)。
	* 隱藏: ```display_errors = Off```。

* 記憶體使用限制
	* 設定 128 MB: ```memory_limit = 128M``` (預設值)。

* Extension 檔案資料夾位置
	* PHP 資料夾路徑下: ```extension_dir = "C:/Program Files (x86)/PHP/ext"```(預設值)。

* 限制是否允許上傳檔案
	* 是: ```file_uploads = On``` (預設值)。
	* 否: ```file_uploads = Off```。
	
* 單一 request 同時最大上傳數
	* 限制 20 個: ```max_file_uploads = 20```(預設值)。

#### httpd.conf
* 舉例，將根目錄更改至 ```D:/www/```。
* 開啟 Apache2.2 資料夾，編輯 ```./conf/httpd.conf```。
* 尋找 **DocumentRoot**，修改其路徑。  
	![windows_httpd_conf_document_root_03](img/windows_httpd_conf_document_root_03.png)
* 尋找標籤 **Directory**，將其路徑值更改。
	![windows_httpd_conf_document_root_05](img/windows_httpd_conf_document_root_05.png)

<br/>
### 小總結
以上是回味一下一步一驚心的安裝 = =a，如果有問題... 再說吧XD 至少哥這台電腦問題都被我解決囉^^ (歡呼


[^1]: Appserv 是一種將Apache、PHP、MySQL包在一起的懶人安裝。
[^2]: 注意有分 Thread Safe 以及 Non Thread Safe 版本，**請下載Thread Safe!!** 要不然後面會有問題，這也是害哥我解了一下午的 Bug
[^3]: 線上文件: [https://docs.google.com/presentation/d/1Bgt8kEOHofGjNjV8j7e4sYU0PM7FDOrInfLzIVuDius/edit#slide=id.i0](https://docs.google.com/presentation/d/1Bgt8kEOHofGjNjV8j7e4sYU0PM7FDOrInfLzIVuDius/edit#slide=id.i0)
[^4]: 注意，這裡面要放你 PHP 安裝位置啊!
[^5]: DocumentRoot 可以從 ```conf/httpd.conf``` 裡面搜尋就知道。
[^6]: 通常會需要 php_bz2.dll、php_mbstring.dll、php_mysql.dll、php_mysqli.dll、php_pdo_mysql.dll。
