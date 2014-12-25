### 說明
以下分享一下最近在 Linux ubuntu 安裝 Apache 的心得。  

我依照步驟沒有出錯，但不敢保證不會有任何狀況發生，但目前是OK的!  

<br/>
### 規格
作業系統: Ubuntu 12.04 (LTS)

首先開啟終端機，開啟終端機快捷鍵: ```Ctrl + Alt + T```

<br/>
### 步驟
* 先切換使用者至 **root權限** 以便後面步驟不用每次都要求認證，所以終端機先輸入 ```sudo du```，此時會要你輸入 **root密碼**，輸入完密碼後終端機之後便會以 root身分 執行指令。  

* 先將位置移到根目錄，可以使用 ```cd ~``` 移到根目錄。

* 安裝 MySQL，終端機輸入 ```apt-get install mysql-server mysql-client```，安裝過程中會要求設定 **MySQL 的密碼**，輸入完後便可以完成安裝 MySQL。

* 安裝 Apache2，終端機輸入 ```apt-get install apache2```，安裝完後[^1]便可以開啟瀏覽器並且輸入網址 [http://127.0.0.1](http://127.0.0.1) 後，就可以瀏覽。

* 安裝 php5，終端機輸入 ```apt-get install php5 libapache2-mod-php5```，安裝完後重新開啟 Apache 後就有 php 功能了，重新開啟 Apache 指令為 ```/etc/init.d/apache2 restart```。

* 此時 Server 就具備有了 php 的功能，所以可以選寫一個 **簡單的php程式** 列出目前的 php 所開啟的功能，終端機輸入指令 ```vi /var/www/info.php``` 用 vi 編輯器[^2]新增檔名為 **info.php** 文件至 ```/var/www/``` 並且編輯它。



* info.php 文件內容程式碼就輸入以下內容 :

	```
	<?php
	  phpinfo ();
	?>
```

	以上內容主要概意是使用內建函式 **phpinfo** 去列出目前 php 所具備開啟的功能；  
	開啟瀏覽器，並且輸入網址 [http://127.0.0.1/info.php](http://127.0.0.1/info.php) 後便可以瀏覽，但此時會發現還**尚未**有 MySQL 的功能。

* 將 MySQL 設定支援 php 使用，終端機輸入 ```apt-cache search php5```。

* 然後再輸入

	```
	apt-get install php5-mysql php5-curl php5-gd php5-intl php-pear php5-imagick php5-imap php5-mcrypt php5-memcache php5-ming php5-ps php5-pspell php5-recode php5-snmp php5-sqlite php5-tidy php5-xmlrpc php5-xsl
	```

* 接著再重新啟動 Apache，一樣是終端機輸入 ```/etc/init.d/apache2 restart```，此時再開啟(重新整理)一次 ```http://127.0.0.1/info.php``` 後就可以發現有了 MySQL 的功能了!

* 安裝 phpMyAdmin，終端機輸入 ```apt-get install phpmyadmin```，安裝過程中會要求選擇此 phpMyAdmin 給哪種系統使用，請選擇 Apache2 即可。之後會要求 *Configure database for phpmyadmin with dbconfig-common?* **選擇 NO** 即可。

* 完成以上動作後，便可以至 [phpMyAdmin網站](http://www.phpmyadmin.net/home_page/index.php) 下載 phpMyAdmin 壓縮包，檔案下載完後解壓縮[^3]並且移到 Apache 的根目錄[^4]，然後改資料夾名稱為 phpMyAdmin，解開完後的資料夾位置會在 ```/home/``` 再將資料夾複製到跟目錄即可[^5]。

* 完成後，開啟瀏覽器並且輸入網址 : [http://127.0.0.1/phpMyAdmin](http://127.0.0.1/phpMyAdmin) 後便可以使用 phpMyAdmin 的功能，帳號密碼為你資料庫的帳號密碼，預設帳號為 **root**。


> 以上步驟參考網站: [http://www.howtoforge.com/installing-apache2-with-php5-and-mysql-support-on-ubuntu-12.04-lts-lamp](http://www.howtoforge.com/installing-apache2-with-php5-and-mysql-support-on-ubuntu-12.04-lts-lamp)  


<br/>
### 2013.08.03 21:44 補充

Windows 安裝 Apache2、php5、MySQL、phpMyAdmin...等更詳細內容，可以參考: [手動安裝 Apache、MySQL、PHP 以及相關設定](手動安裝 Apache、MySQL、PHP 以及相關設定.html)




[^1]: Apache 預設的根目錄為 ```/var/www/```

[^2]: vi 編輯器的使用方式與指令可以參考 : [http://www2.nsysu.edu.tw/csmlab/unix/vi_command.htm](http://www2.nsysu.edu.tw/csmlab/unix/vi_command.htm) 以及 [http://linux.vbird.org/linux_basic/0310vi/0310vi.php](http://linux.vbird.org/linux_basic/0310vi/0310vi.php)  

[^3]: 解壓縮指令可以參考網頁 : [http://fuglemanpeter.blogspot.tw/2012/08/targz-tarbz2.html](http://fuglemanpeter.blogspot.tw/2012/08/targz-tarbz2.html)

[^4]: 預設的根目錄為 ```/var/www/```

[^5]: 解壓縮、複製的指令要注意正確與否，經常造成錯誤原因都是因為路徑打錯，複製資料夾以及重新命名的指令可以參考網頁 : [http://www.arthurtoday.com/2010/09/ubuntu-cp-mv.html#.UeqFDSEW0ak](http://www.arthurtoday.com/2010/09/ubuntu-cp-mv.html#.UeqFDSEW0ak)