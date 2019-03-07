本機開發者又不想架設 VM 怎麼辦？那就直接在 macOS 下安裝 Apache 吧！

# macOS 上安裝 Apache
## Youtube 影音教學版
* [https://www.youtube.com/watch?v=V32zn8xtGnM](https://www.youtube.com/watch?v=V32zn8xtGnM)

## 安裝步驟
* 更新 xcode command line，終端機下 `xcode-select --install`
* 更新 Brew `brew update`
* 移除停止使用 mac 原生的 Apache
	* 先暫停 Apache `sudo apachectl stop`
	* 自動開啟先關閉 `sudo launchctl unload -w /System/Library/LaunchDaemons/org.apache.httpd.plist 2>/dev/null`
* 安裝新的 Apache
	* 用 Brew 安裝 `brew install httpd`
	* 啟動 Apache `sudo brew services start httpd`
	* 設定 `ps -aef | grep httpd`
	* 重開 `sudo apachectl -k restart`
* 新 Apache 指令
	* 開啟 `sudo apachectl start`
	* 關閉 `sudo apachectl stop`
	* 重開 `sudo apachectl -k restart`
* 新 Apache 相關設定
	* 用 Sublime Text 打開編輯 `/usr/local/etc/httpd/httpd.conf`，終端機執行指令 `subl /usr/local/etc/httpd/httpd.conf`
	* 修改 `Listen 8080` 改為 `Listen 80`
	* 修改 `DocumentRoot "/usr/local/var/www"`，改成指定位置 `DocumentRoot "/Users/oa/www"`
	* 修改 `<Directory "/usr/local/var/www">`，改成指定位置 `<Directory "/Users/oa/www">`
	* 拿掉註解 `LoadModule rewrite_module lib/httpd/modules/mod_rewrite.so`
	* 拿掉註解，並改成 `ServerName localhost`
	* 拿掉註解 `Include /usr/local/etc/httpd/extra/httpd-vhosts.conf`
	* 為了之後方便常常設定，不用每次輸入密碼，開啟終端機，輸入指令 `sudo chmod 777 /usr/local/etc/httpd/httpd.conf` 將權限打開
	* 為了之後方便常常設定，所以建立一個鏈結，開啟終端機，輸入指令 `ln -s /usr/local/etc/httpd/httpd.conf ~/Documents/httpd.conf`
* 重開 Apache `sudo apachectl -k restart`

## 設定 Host
* 位置在 `/etc/hosts`
* 為了之後方便常常設定，不用每次輸入密碼，終端機執行指令 `sudo chmod 777 /etc/hosts` 將權限打開
* 為了之後方便常常設定，所以建立一個鏈結，終端機執行指令 `ln -s /etc/hosts ~/Documents/hosts`
* 用 Sublime Text 打開編輯 `/etc/hosts`，終端機執行指令 `subl /etc/hosts`，將內容調整一下，常用內容如下：

```
127.0.0.1 dev.case.ioa.tw
```

## 設定 Virtual Host
* 位置在 `/usr/local/etc/httpd/extra/httpd-vhosts.conf`
* 為了之後方便常常設定，不用每次輸入密碼，開啟終端機，輸入指令 `sudo chmod 777 /usr/local/etc/httpd/extra/httpd-vhosts.conf` 將權限打開
* 為了之後方便常常設定，所以建立一個鏈結，開啟終端機，輸入指令 `ln -s /usr/local/etc/httpd/extra/httpd-vhosts.conf ~/Documents/httpd-vhosts.conf`
* 用 Sublime Text 打開編輯 `/usr/local/etc/httpd/extra/httpd-vhosts.conf`，終端機執行指令 `subl /usr/local/etc/httpd/extra/httpd-vhosts.conf`，將內容調整一下，常用內容如下：

```
# root
<VirtualHost *:80>
  ServerAdmin comdan66@gmail.com
  DocumentRoot "/Users/oa/www"

  <Directory "/Users/oa/www">
      Options FollowSymLinks MultiViews
      AllowOverride All
      Order allow,deny
      Allow from all
  </Directory>
</VirtualHost>

# Case
<VirtualHost *:80>
  ServerName dev.case.ioa.tw
  ServerAlias dev.case.ioa.tw

  DocumentRoot "/Users/oa/www/case"
  <Directory "/Users/oa/www/case">
      Options FollowSymLinks MultiViews
      AllowOverride All
      Order allow,deny
      Allow from all
  </Directory>
</VirtualHost>
```

* 設定好後，記得重開 Apache，終端機執行指令 `sudo apachectl -k restart`

> 請注意路徑，此 `vhosts.conf` 的 `DocumentRoot` 與 `Directory` 路徑為 OA 本人的，請注意自己的路徑是否正確。

## 設定 https 的 ssl 功能
此功能一般來說不太會用到，所以不一定要安裝，不需要的話直接跳過即可！

因為通常都是本機開發，所以就藉由 openssl 來做本機開發吧！

* 編輯 Conf，指令輸入 `subl /usr/local/etc/httpd/httpd.conf`
* 將以下三個註解拿掉

```
LoadModule socache_shmcb_module lib/httpd/modules/mod_socache_shmcb.so
```

```
LoadModule ssl_module lib/httpd/modules/mod_ssl.so
```

```
Include /usr/local/etc/httpd/extra/httpd-ssl.conf
```

* 編輯 SSL Conf，指令輸入 `subl /usr/local/etc/httpd/extra/httpd-ssl.conf`
* 將 `Listen 8443` 改為 `Listen 443`
* 將 `<VirtualHost _default_:8443>` 改為 `<VirtualHost _default_:443>`
* 將 `DocumentRoot` 與 `ServerName` 註解
* 編輯 vhost，指令輸入 `subl /usr/local/etc/httpd/extra/httpd-vhosts.conf`
* 新增以下

```
<VirtualHost *:443>
    DocumentRoot "/Users/oa/www"
    ServerName localhost
    SSLEngine on
    SSLCertificateFile "/usr/local/etc/httpd/server.crt"
    SSLCertificateKeyFile "/usr/local/etc/httpd/server.key"
</VirtualHost>
```

* 第一次設定，需要產生 key，所以要執行 openssl
* 終端機進入目錄，指令 `cd /usr/local/etc/httpd`
* 產生 ssl key，指令 `openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout server.key -out server.crt`，中間要你輸入資料，因為是本機開發，所以簡單輸入即可
* 執行 `sudo apachectl configtest`
* 重新啟動 `sudo apachectl -k restart`

## 重點整理
* Conf 位置 `/usr/local/etc/httpd/httpd.conf`
* Vhosts 位置 `/usr/local/etc/httpd/extra/httpd-vhosts.conf`
* 開啟 Apache，終端機執行指令 `sudo apachectl start`
* 關閉 Apache，終端機執行指令 `sudo apachectl stop`
* 重開 Apache，終端機執行指令 `sudo apachectl -k restart`


### 相關參考
* [https://getgrav.org/blog/macos-mojave-apache-ssl](https://getgrav.org/blog/macos-mojave-apache-ssl)

`#Apache` `#後端`
