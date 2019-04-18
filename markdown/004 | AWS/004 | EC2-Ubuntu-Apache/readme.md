# EC2 Ubuntu 安裝 Apache

## 假設
* 以下操作先做假設
	* Elastic IPs：`123.456.789`
	* 下載的 .pem 檔案名稱：`test.pem`
	* `test.pem` 位置：`/User/oa/test.pem`
	* 網址(domain)：`your.url.tw`
	* E-Mail：`your.email@gmail.com`
	* 以下編輯器主要是使用 `nano`，請自行斟酌是否使用 `vi` 或 `vim`

> 記得去你的 DNS(Domain Name Server) 設定，新增 `A` 紀錄 `your.url.tw`，指向 IP `123.456.789`

## 安裝 Apache
* 更新 apt，指令：`sudo apt update`
* 安裝 Apache，指令：`sudo apt install apache2`，一樣會問你 `Do you want to continue? [Y/n]`，按下 `Y` 後 `enter` 即可。

## 建立 WWW 目錄

* 預設目錄在 `/var/www`，先將其權限做調整，輸入指令：`sudo chmod -R 777 /var/www`
* 進入預設 www 目錄，輸入指令：`cd /var/www`
* 移除 `html` 目錄，指令：`rm -rf html`
* 新增 index.html，編輯檔案，輸入指令：`nano index.html`，簡單的輸入 `Hello World！` 後儲存離開。
* 在 Home 下建立捷徑，指令 `ln -s /var/www ~/www`

## 設定 Apache

* 啟動 Apache，指令：`sudo service apache2 start`，然後開啟你的網頁檢查有沒有成功，網頁網址輸入 `your.url.tw`，也就是 `http://your.url.tw/`，如果可以開啟就代表 Apache 安裝成功。
* 筆記 apache2 指令：
	* 啟動：`sudo service apache2 start`
	* 停止：`sudo service apache2 stop`
	* 重啟：`sudo service apache2 restart`

* 複製一份 vhost 檔案，指令 `sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/my.conf`
* 啟用 `my.conf`，指令：`sudo a2ensite my.conf`
* 重新載入 Apache 設定，指令：`sudo systemctl reload apache2`
* 關閉 `000-default.conf`，指令 `sudo a2dissite 000-default.conf`，注意喔，指令是 `a2dissite`
* 重新載入 Apache 設定，指令：`sudo systemctl reload apache2`
* 編輯 `my.conf`，指令：`sudo nano /etc/apache2/sites-available/my.conf`，可以用以下當範例：

```
<VirtualHost *:80>
  # 你的 Domain
  ServerName your.url.tw
  ServerAlias your.url.tw

  # 你的 E-Mail
  ServerAdmin your.email@gmail.com

  # 你的專案目錄
  DocumentRoot /var/www
  
  # Log 的儲存位置
  ErrorLog ${APACHE_LOG_DIR}/error.log
  CustomLog ${APACHE_LOG_DIR}/access.log combined

  # 記得也要是你的專案目錄
  <Directory /var/www>
      Options FollowSymLinks MultiViews
      AllowOverride All
      Order allow,deny
      Allow from all
  </Directory>
</VirtualHost>
```

* 重啟 Apache 即可，指令：`sudo service apache2 restart`

## 打開 rewrite mode

* 指令輸入 `sudo a2enmod rewrite`
* 重新開啟 `sudo service apache2 restart`

## 以上參考：
* [http://comdan66.github.io/configs/book/mds/ec2-ubuntu/apache.html](http://comdan66.github.io/configs/book/mds/ec2-ubuntu/apache.html)

* [https://note.artchiu.org/2016/06/17/lets-encrypt-%E4%BD%BF%E7%94%A8%E8%AA%AA%E6%98%8E-%E9%9D%9E%E5%AE%98%E6%96%B9/](https://note.artchiu.org/2016/06/17/lets-encrypt-%E4%BD%BF%E7%94%A8%E8%AA%AA%E6%98%8E-%E9%9D%9E%E5%AE%98%E6%96%B9/)

`#AWS` `#EC2` `#Apache` `#http`