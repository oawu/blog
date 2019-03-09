# EC2 Ubuntu 安裝 MySQL

* 在 EC2 上安裝 MySQL，輸入指令：`sudo apt-get install mysql-server mysql-client`
* 途中會需要你輸入密碼與確認密碼，輸入密碼過程中不會顯示，請不要驚訝，輸入完後按下 `enter` 即可。
* 驗證是否安裝成功，輸入指令：`mysql -u root -p` 後，接著會需要輸入密碼輸入密碼過程中不會顯示，請不要驚訝，輸入完後按下 `enter` 即可。
* EC2 上的 MySQL 預設是沒有對外的，所以需要修改外部連接權限，修改 MySQL 的 /my.cnf，輸入指令：`sudo nano /etc/mysql/my.cnf`，將其 `bind-address` 改為 `0.0.0.0` (任何地方)
* 重新啟動 MySQL，輸入指令：`sudo service mysql restart`

## 以上參考：
* [http://comdan66.github.io/configs/book/mds/ec2-ubuntu/apache.html](http://comdan66.github.io/configs/book/mds/ec2-ubuntu/apache.html)

`#AWS` `#EC2` `#MySQL`