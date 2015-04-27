### 說明
因為都是使用 CodeIgniter 做專案開發，所以最近研究了一下，終於在 GitHub 上找到一位大大的 [Redis Library](https://github.com/joelcox/codeigniter-redis)！

<br/>
### 規格
* Framework - [CodeIgniter](http://www.codeigniter.org.tw/)


<br/>
### 步驟
* 至 [Joël Cox](https://github.com/joelcox) 大大的 [GitHub](https://github.com/joelcox/codeigniter-redis) 下載 codeigniter-redis。

* 如果可以的話，也確保你的 Redis 已經可以使用，到時候好測試！

* CodeIgniter 內加入檔案。
	* ```./application/libraries/``` 目錄下加入 **Redis.php**

	* ```./application/config/``` 目錄下加入 **redis.php**

* 設定 Redis Server 位置、Port、密碼。
	* 編輯 ```./application/config/redis.php```

		```
	$config['redis_default']['host'] = '127.0.0.1';   // IP address or host
	$config['redis_default']['port'] = '6379';        // Default Redis port is 6379
	$config['redis_default']['password'] = '';        // Can be left empty when the server does not require AUTH
```

<br/>
### 小筆記
* Mac OSX 上安裝 Redis 可以參考 [這篇](mac os 安裝 redis.html)。
* 使用 phpRedisAdmin 管理 Redis 資料，的話可以參考 [這篇](phpredisadmin 安裝.html)。