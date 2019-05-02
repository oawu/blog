# EC2 Ubuntu 安裝 PHP

## 假設
* 以下操作先做假設
	* Elastic IPs：`123.456.789`
	* 下載的 .pem 檔案名稱：`test.pem`
	* `test.pem` 位置：`/User/oa/test.pem`
	* 網址(domain)：`your.url.tw`
	* E-Mail：`your.email@gmail.com`
	* 以下編輯器主要是使用 `nano`，請自行斟酌是否使用 `vi` 或 `vim`

> 記得去你的 DNS(Domain Name Server) 設定，新增 `A` 紀錄 `your.url.tw`，指向 IP `123.456.789`

## 安裝 PHP
* 使用 apt 安裝，指令 `sudo apt install php-fpm libapache2-mod-php php-curl php-imagick php-mysql php-gd php-mbstring php-xml`
* 檢查版本，確認是否安裝成功，指令：`php -v`
* 在 www 下新增 PHP 檔案，指令 `nano phpinfo.php`，內容為如下：

```
<?php
phpinfo();
```
* 重啟 Apache：`sudo service apache2 restart`，瀏覽器開啟網址：`http://123.456.789/phpinfo.php`
* 檢查是否有 `imagick`、`curl`、`mysqli`、`pdo_mysql`、`gd`、`mbstring` 功能。

## 以上參考：
* [http://comdan66.github.io/configs/book/mds/ec2-ubuntu/apache.html](http://comdan66.github.io/configs/book/mds/ec2-ubuntu/apache.html)

* [https://note.artchiu.org/2016/06/17/lets-encrypt-%E4%BD%BF%E7%94%A8%E8%AA%AA%E6%98%8E-%E9%9D%9E%E5%AE%98%E6%96%B9/](https://note.artchiu.org/2016/06/17/lets-encrypt-%E4%BD%BF%E7%94%A8%E8%AA%AA%E6%98%8E-%E9%9D%9E%E5%AE%98%E6%96%B9/)

`#AWS` `#EC2` `#PHP`