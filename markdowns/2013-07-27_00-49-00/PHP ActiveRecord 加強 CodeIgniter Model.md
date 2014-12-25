### 說明
繼上次初步講解了 [CodeIgniter](usbwebserver 以及 codeigniter 初步介紹.html) 的使用後，這次整理了最近學到的東西 **PHP ActiveRecord**，他是 CI 的一個 spark 擴充功能，在 Linux 或者 MAC OS 其實比較好安裝，如果要在 windows 上就不好弄了..

其主要是將 CI Model 加強化的 ORM，讓 Model 在使用資料庫上更加的人性化，Google 一下就會有很多資料了，在這邊就不多做解釋了。

> 不過要注意 如果要使用 PHP ActiveRecord 的話，請先確定 **PHP 版本是少要到 3 以上** !
> 以及 **php.ini** 內的 **php_pdo_mysql.dll** 是否有被啟用!!


<br />
### 步驟
安裝方法其實 Google 到的資訊不多，但最主要參考 [http://www.youtube.com/watch?v=RL-loGlI2t4](http://www.youtube.com/watch?v=RL-loGlI2t4) 這部教學內容就夠了，這位作者還放了很多關於使用例子。以下是影片中安裝概略，如果有差錯請自行再參考影片! 基本上下面的方法在 Windows & USBWebserver v8.5 上面也是可以成功的！

* 首先當然先下載好 [CodeIgniter](http://www.codeigniter.org.tw/) ，下載後檔案 [CodeIgniter_2.1.3.zip](https://ellislab.com/codeigniter/user-guide/installation/downloads.html) 即是。

* 可到 [http://getsparks.org/install#option-1](http://getsparks.org/install#option-1) 看安裝過程，先下載 spark-manager，下載後檔案 [spark-manager-0.0.9.zip](http://getsparks.org/download) 即是。

* 壓縮 [CodeIgniter_2.1.3.zip](https://ellislab.com/codeigniter/user-guide/installation/downloads.html) 後可以先命名該資料夾名稱為 **CodeIgniter** 並且放於你的 Web Server 的根目錄，在目錄內新增一個資料夾命名為 **tools**，並且將 spark-manager-0.0.9.zip 的內容解壓縮至此。

* 一樣在 [http://getsparks.org/install#option-1](http://getsparks.org/install#option-1) 下載 [MY_Loader.php](http://getsparks.org/static/install/MY_Loader.php.txt)，並且將檔案放置 ```CodeIgniter/application/core/``` 內。

* 使用 command line 了，先開啟 cmd.exe 並且位置移到 CodeIgniter 目錄下，然後下指令 ```php tools/spark install php-activerecord``` 並且執行，完後會發現 CodeIgniter 目錄下會多出一個資料夾名稱為 **sparks** 那就代表成功啦[^1]。

* 開啟 ```/CodeIgniter/application/config/autoload.php``` 並且加入一行程式碼 ```$autoload['sparks'] = array('php-activerecord/0.0.2');``` 即可[^2]。

基本上由以上步驟就算完成了 CodeIgniter 的 PHP ActiveRecord  匯入。

<br />
### Demo
如果想在自己試試看是真的安裝成功，可以自己試試看一個 Model  ，不過首先你要先設定資料庫連線。

* 先開啟 ```/CodeIgniter/application/config/database.php``` 填寫要連接資料庫的 username、password、database... 等資訊[^3]。

* 建立資料表並且命名為 members，可以新增幾個欄位，並且先新增幾筆資料。

* 在 ```/CodeIgniter/application/models/``` 目錄下新增文件，並且命名為 member.php，並且將內容修改成如下 :

	```
	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	  class Member extends ActiveRecord\Model {
	    static $table_name = 'members';
	  }
	?>
```

* 然後開啟文件 ```/CodeIgniter/application/controllers/welcome.php```，將其內容修改成如下:

	```
	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	  class Welcome extends CI_Controller {
	    public function index()   {
	      $result = Member::all();
	      echo "<pre>";
	      print_r ($result);
	      echo "</pre>";
	    }
	  }
	?>
```

* 以上步驟完後，再開啟瀏覽器，並且輸入網址 [http://127.0.0.1/CodeIgniter/](http://127.0.0.1/CodeIgniter/) 即可看到結果。

詳細的 PHP ActiveRecord 使用方式其實在官網都有詳細範例了，詳情可以參考 [http://www.phpactiverecord.org/](http://www.phpactiverecord.org/)。


> **※ 不負責任筆記**: 以上如果有任何問題，歡迎提問吧，在我電腦上目前安裝以及使用上階尚未出錯，但不代表是絕對正確XD


<br />
### 2013.08.03 21:45 補充

完整自己手動安裝可以參考這篇: [當 codeigniter 碰上 php-activerecord](當 codeigniter 碰上 php-activerecord.html)


[^1]: 此步驟要有安裝 php 才可行，若是使用 之前文章 提到的 USBWebserver 的話，就 cmd.exe 目錄移到 USBWebserver 的 php目錄 下，並在此目錄下指令 php ../root/CodeIgniter/tools/spark install php-activerecord 執行過程會有多個錯誤警告訊息，但按確定繼續即可，完後會發現 php 目錄下多出 sparks 資料夾，再將其移到 CodeIgniter 目錄下即可。

[^2]: 要注意 /CodeIgniter/sparks/php-activerecord 目錄下的版本資料夾是否也為 0.0.2 ，若是版本資料夾不一樣，則請自行將程式碼改成一樣即可。

[^3]: 若是使用 USBWebserver  的話 username 為 root ， password 為 usbw 。