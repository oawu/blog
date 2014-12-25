### 說明
每次在建立起新環境後，都會面臨到 [CodeIgniter](http://www.codeigniter.org.tw/) 上的一點小問題，所以此篇筆記筆記。

<br/>
### 規格
* Http server - [Apache2](http://httpd.apache.org/)
* Framework - [CodeIgniter](http://www.codeigniter.org.tw/)


<br/>
### 狀況、解法
通常我會習慣把 index.php 給隱藏，這時候就得借助 **.htaccess** 檔案來設定，這時候就必須修改幾個東西！

* rewrite

	* Linux - 執行指令 ```sudo a2enmod rewrite```。

	* Winsow - ```#LoadModule rewrite_module modules/mod_rewrite.so``` 修改成 ```LoadModule rewrite_module modules/mod_rewrite.so```

* AllowOverride - 將 **Directory** 內的 **AllowOverride** 改成 **All**。

* 重新起動 Apache。