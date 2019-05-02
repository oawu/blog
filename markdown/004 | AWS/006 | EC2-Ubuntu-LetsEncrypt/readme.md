# EC2 Ubuntu 安裝 Let's Encrypt

## 假設
* 以下操作先做假設
	* Elastic IPs：`123.456.789`
	* 下載的 .pem 檔案名稱：`test.pem`
	* `test.pem` 位置：`/User/oa/test.pem`
	* 網址(domain)：`your.url.tw`
	* E-Mail：`your.email@gmail.com`
	* 以下編輯器主要是使用 `nano`，請自行斟酌是否使用 `vi` 或 `vim`

> 記得去你的 DNS(Domain Name Server) 設定，新增 `A` 紀錄 `your.url.tw`，指向 IP `123.456.789`

## Let's Encrypt(ssl)

* 安裝 curl，指令 `sudo apt install curl`
* 進入 www 目錄，指令 `cd ~/www`
* 從 Git 下載最新 dehydrated，指令 `git clone https://github.com/lukas2511/dehydrated.git`
* 進入專案，指令 `cd dehydrated`
* 新增目錄，指令 `sudo mkdir /etc/dehydrated/`
* 修改權限，指令 `sudo chmod 777 /etc/dehydrated/`
* 將檔案移進去，指令 `cp dehydrated /etc/dehydrated/`
* 修改 dehydrated 權限 `chmod a+x /etc/dehydrated/dehydrated`
* 建立證驗時所需目錄，指令 `mkdir -p /var/www/dehydrated/`
* 第一次執行同意 Let's Encrypt 的條款，指令 `/etc/dehydrated/dehydrated --register --accept-terms`


## 新增 SSL by Let's Encrypt

* Apache，在該專案下的 `http` vhost 內，加入指令 `Alias /.well-known/acme-challenge/ /var/www/dehydrated/`

* nginx，在該專案下的 `http` vhost 中的 server 內加入以下指令：

	```
location /.well-known/acme-challenge/ {
    alias /var/www/dehydrated/;
}
```

* 重新載入 Apache 設定，指令：`sudo systemctl reload apache2`

* 取得憑證 `/etc/dehydrated/dehydrated -c -d your.url.tw`


## 啟用 Apache SSL 功能

### 第一次使用

* 啟用，輸入指令：`sudo a2enmod ssl`

* 複製一份 ssl vhost 檔案指令 `sudo cp /etc/apache2/sites-available/default-ssl.conf /etc/apache2/sites-available/my-ssl.conf`

* 啟用 `my-ssl.conf`，指令：`sudo a2ensite my-ssl.conf`

* 重新載入 Apache 設定，指令：`sudo systemctl reload apache2`

### 不是第一次

* 編輯 `my-ssl.conf`，指令：`sudo nano /etc/apache2/sites-available/my-ssl.conf`，可以用以下當範例：

```
<IfModule mod_ssl.c>

  <VirtualHost _default_:443>
    # 你的 Domain
    ServerName  your.url.tw
    ServerAlias your.url.tw

    # 你的 E-Mail
    ServerAdmin your.email@gmail.com

    # 你的專案目錄
    DocumentRoot /var/www

    # Log 的儲存位置
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
	
	 ## SSL 設定
    SSLEngine on
    SSLCertificateFile /etc/dehydrated/certs/your.url.tw/cert.pem
    SSLCertificateKeyFile /etc/dehydrated/certs/your.url.tw/privkey.pem
    SSLCertificateChainFile /etc/dehydrated/certs/your.url.tw/chain.pem

    # 記得也要是你的專案目錄
    <Directory /var/www>
      Options FollowSymLinks MultiViews
      AllowOverride All
      Order allow,deny
      Allow from all
    </Directory>
  </VirtualHost>

</IfModule>
```

* 重啟 Apache 即可，指令：`sudo service apache2 restart`

### 重啟錯誤

* 若出現以下錯誤，代表你還沒申請 ssl 的憑證檔案，所以出錯。

	```
Job for apache2.service failed because the control process exited with error code.
See "systemctl status apache2.service" and "journalctl -xe" for details.
```

* 所以，先把 `my-ssl.conf` 停用再重開 Apache，指令：`sudo a2dissite my-ssl.conf`
* 重新載入 Apache 設定，指令：`sudo systemctl reload apache2`
* 重啟 Apache 即可，指令：`sudo service apache2 restart`
* 然後 執行上述的 `新增 SSL by Let's Encrypt`


## 以上參考：

* [http://comdan66.github.io/configs/book/mds/ec2-ubuntu/apache.html](http://comdan66.github.io/configs/book/mds/ec2-ubuntu/apache.html)

* [https://note.artchiu.org/2016/06/17/lets-encrypt-%E4%BD%BF%E7%94%A8%E8%AA%AA%E6%98%8E-%E9%9D%9E%E5%AE%98%E6%96%B9/](https://note.artchiu.org/2016/06/17/lets-encrypt-%E4%BD%BF%E7%94%A8%E8%AA%AA%E6%98%8E-%E9%9D%9E%E5%AE%98%E6%96%B9/)

`#AWS` `#EC2` `#Let's Encrypt` `#https`