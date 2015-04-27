### 說明
整理了一下最近學到的 [Redis](http://redis.io/)，所以就來整理一下囉！從 Google 上可以找到一些關於 Radis 的介紹，大致上有以下幾項特性:  

* 開放原始碼
* 支援網路
* 基於記憶體
* 鍵值對儲存資料庫
* 豐富的資料結構功能：Strings、Hashes、Lists、
Sets、Sorted Sets、Pub/Sub

所支援的語言更有 ActionScript、C、C++、C#、Clojure、Common、 Lisp、Dart、Erlang、Go、Haskell、Haxe、Io、Java、Node.js、Lua、Objective-C、Perl、PHP、Pure Data、Python、R[5]、Ruby、Scala、Smalltalk、Tcl….之多，不過我主要還是拿來當 php 的應用！ 以下會介紹在 Mac OSX 上的安裝，以及 CodeIgniter 上面的使用...等！

<br/>
### 規格
* OS - Mac OSX

<br/>
### 步驟
* 依順序輸入以下步驟:
	* 取得 redis，輸入指令: ```wget http://download.redis.io/releases/redis-2.8.3.tar.gz```
	* 解壓縮，輸入指令: ```tar xzf redis-2.8.3.tar.gz```
	* 進入資料夾，輸入指令: ```cd redis-2.8.3```
	* 安裝，輸入指令: ```sudo make test```
	* 安裝，輸入指令: ```make```
	
* 啓動 Redis Server，輸入指令: ```redis-server```
	![redis_server](img/redis_server-compressor.png)
	
* 接下來啟動 Redis 的 Client，輸入指令: ```redis-cli```
	![redis_cli](img/redis_cli-compressor.png)
	
	
<br/>
### 小總結
開啓 Redis 的 Client 後，就可以用指令去查詢，如果一直不能習觀沒有 GUI 界面的話，可以參考[這篇](phpredisadmin 安裝.html)使用 [phpRedisAdmin](https://github.com/ErikDubbelboer/phpRedisAdmin) 的管理界面！
