### 說明
這陣子因為需要去爬各大拍賣網站的資料，正常來說 php 不是用 cURL 就是用 file_get_contents 去爬人家的資料，取回來之後要拆解就很麻煩了，多數都會用正規 [preg_match](http://php.net/manual/en/function.preg-match.php)、[preg_match_all](http://php.net/manual/en/function.preg-match-all.php) 等方法去塞選出需要的資訊。

不過最近找到個不錯的 library，它叫做 [phpQuery](https://code.google.com/p/phpquery/) ([GitHub](https://github.com/TobiaszCudnik/phpquery))，基本上如果會用 [jQuery](http://jquery.com/) 取資料的話，那應該使用 phpQuery 會更是得心應手！因為用法跟語法幾乎都一模一樣！ 因為現在是使用 [CodeIgniter](http://www.codeigniter.org.tw/) 開發，所以以下就用 CodeIgniter 當範例囉！

<br/>
### 規格
* Framework - [CodeIgniter](http://www.codeigniter.org.tw/)
* phpQuery - [phpQuery](https://code.google.com/p/phpquery/)

<br/>
### 步驟	
* CodeIgniter libraries 加入 phpQuery 檔案：

	```
	phpQuery.php
	phpQuery/DOMEvent.php
	phpQuery/DOMDocumentWrapper.php
	phpQuery/phpQueryEvents.php
	phpQuery/Callback.php
	phpQuery/phpQueryObject.php
	phpQuery/compat/mbstring.php
```

	>
<span style='color:red'>※ 注意！</span>  
從 phpQuery git hub 下載下來的檔案中要特別注意，在 phpQuery.php 內的 phpQuery class 的形態是 abstract，
如果要讓 CodeIgniter 能夠使用的話，請先將 abstract 形態拿掉，才能讓 CodeIgniter load library。另外如果是 Linux 系統的話，要注意檔案名稱大小寫！
	
* 使用時 ```$this->load->library ('phpQuery');``` 即可！
* 基本範例:

	```
	$php_query = phpQuery::newDocument ($html_string);
	$block = pq ("#block", $php_query);
	$content = $block->text ();
 
	echo $content;
```

<br/>
### 相關參考
* PhpQuery 相關網站
	1. Git Hub - [https://github.com/TobiaszCudnik/phpquery](https://github.com/TobiaszCudnik/phpquery)
	2. PhpQuery Google Wiki - [https://code.google.com/p/phpquery/wiki/Selectors](https://code.google.com/p/phpquery/wiki/Selectors)

* jQuery 相關網站
	1. jQuery 官網 - [http://jquery.com/](http://jquery.com/)
