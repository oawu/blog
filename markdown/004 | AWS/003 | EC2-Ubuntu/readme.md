# EC2 上的 Ubuntu

* 以下會教學新的 Ubuntu 常用的幾項基本設定，主要有 `Git`、`Zsh`、`SSH` 設定。
* 經過設定 `Elastic IPs` 後，我們就可以藉由其 IP 與下載的 .pem 檔案做第一次的 ssh 連線遠端登入 Server

## 假設
* 以下操作先做假設
	* Elastic IPs：`123.456.789`
	* 下載的 .pem 檔案名稱：`test.pem`
	* `test.pem` 位置：`/User/oa/test.pem`
	* 網址(domain)：`your.url.tw`
	* E-Mail：`your.email@gmail.com`
	* 以下編輯器主要是使用 `nano`，請自行斟酌是否使用 `vi` 或 `vim`

> 記得去你的 DNS(Domain Name Server) 設定，新增 `A` 紀錄 `your.url.tw`，指向 IP `123.456.789`

## 首次登入

* 先設定 `test.pem` 檔案的權限，指令：`chmod 400 /User/oa/test.pem`
* 以 `ssh` 方式，藉由 `test.pem` 登入 Server，輸入指令：`ssh ubuntu@123.456.789 -i /User/oa/test.pem`，第一次會問你要不要加入此 IP 的紀錄，你就輸入 `yes` 後按下 `enter` 即可。

## 安裝 Git

* 安裝 Git，指令：`sudo apt install git`
* 檢查版本，確認是否安裝成功，指令：`git --version`

## 安裝 Oh My Zsh

* 修改 `chsh` 權限，編輯指令：`sudo nano /etc/pam.d/chsh`

* 將 `auth required pam_shells.so` 改為  `auth sufficient pam_shells.so`

	> 改為 `auth sufficient pam_shells.so` 主要是因為後面更改 Shell 都會詢問密碼，但是你是藉由 `test.pem` 方式登入，所以沒有密碼，因此才改為 `sufficient`

* 安裝 `zsh`，指令：`sudo apt install zsh`，中間會問你 `Do you want to continue? [Y/n]`，按下 `Y` 後 `enter` 即可。

* 使用 `oh-my-zsh` 主題，指令：`curl -L https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh | sh`

* 重新 ssh 連線，輸入指令：`exit`，然後再重新連線，指令：`ssh ubuntu@123.456.789 -i /User/oa/test.pem`

## 設定時間

* 初始的 Ubuntu 會有時間誤差，所以需要校正，並且設定 Local 的時間
* 設定本地區域，輸入指令：`sudo timedatectl set-timezone Asia/Taipei`
* 校正時間，檢查時間與本地端(你的電腦)是否正確，輸入指令：`timedatectl`

## 設定語系
* 設定中文語系，沒設定會有亂碼，指令：`sudo locale-gen zh_TW.UTF-8`

## 產生 SSH Key
* 輸入指令：`ssh-keygen -t rsa -C "your.email@gmail.com"`
* 連續按下幾個 `enter` 後即可完成。

## 藉由 Authorized Keys 登入
* 開啟本機端的終端機，複製 Public key，輸入指令：`pbcopy < ~/.ssh/id_rsa.pub`
* 上 Server，輸入指令：指令：`ssh ubuntu@123.456.789 -i /User/oa/test.pem`
* 加入你的 key 到 `authorized_keys`，輸入指令：`nano ~/.ssh/authorized_keys`
* 在 `authorized_keys` 內的檔案最後面加上你剛剛複製的本機端 Public key
* 如此一來，你就不用每次都要藉由 `test.pem` 的方式登入，但也記得請好好的保存 `test.pem`


## 以上參考：

* [http://comdan66.github.io/configs/book/mds/ec2-ubuntu/apache.html](http://comdan66.github.io/configs/book/mds/ec2-ubuntu/apache.html)

* [https://note.artchiu.org/2016/06/17/lets-encrypt-%E4%BD%BF%E7%94%A8%E8%AA%AA%E6%98%8E-%E9%9D%9E%E5%AE%98%E6%96%B9/](https://note.artchiu.org/2016/06/17/lets-encrypt-%E4%BD%BF%E7%94%A8%E8%AA%AA%E6%98%8E-%E9%9D%9E%E5%AE%98%E6%96%B9/)

`#AWS` `#EC2` `#Git` `#Zsh` `#SSH`