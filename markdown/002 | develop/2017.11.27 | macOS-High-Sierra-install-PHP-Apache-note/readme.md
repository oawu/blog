# 2017 macOS High Sierra 安裝 PHP Apache 筆記

最近因為需要開發 iOS App 所以逼得我自己需要把 Mac OS 更新到最新版本，但更新完後發現內建在 OSX 中的 PHP 版本居然變成了 7，變成 PHP 7 是不打緊，只是我需要的 PHP-imagick 套件一直安裝不起來，覺得氣餒，所以為了解決這問題下了一點點功課。

基本上在網路上找相關的解法都是用 [Homebrew](https://brew.sh/index_zh-tw.html) 來解決這項問題，找了大半天終於讓我找到一篇完整的介紹，以下就用[此篇](https://getgrav.org/blog/macos-sierra-apache-multiple-php-versions)來說明利用 Homebrew 來針對 PHP 版本控制的方法吧！

### 環境設定
更新 xcode command line，終端機下 `xcode-select --install`

### 安裝 Homebrew
* 安裝 Homebrew `ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"`
* 顯示版本 `brew --version`
* 檢查 `Brew brew doctor`
* 執行設定 `brew tap homebrew/php`，Tap 的用意是之後就不用再打 `homebrew/php`，例如 `brew install homebrew/php/php71 --with-apache`，就可以直接 `brew install php71 --with-apache`
* 更新 `brew brew update`

### 移除停止使用 mac 原生的 Apache

先暫停 Apache `sudo apachectl stop` 與 `sudo launchctl unload -w /System/Library/LaunchDaemons/org.apache.httpd.plist 2>/dev/null`

### 安裝新的 Apache

* 用 Brew 安裝 `brew install httpd`
* 啟動 `sudo brew services start httpd`
* 設定 `ps -aef | grep httpd`
* 重開 `sudo apachectl -k restart`

### 新 Apache 指令

* 開啟 `sudo apachectl start`
* 關閉 `sudo apachectl stop`
* 重開 `sudo apachectl -k restart`

### 新 Apache 相關設定

* 編輯 `/usr/local/etc/httpd/httpd.conf`
* 修改一下項目
  * Listen 80
  * DocumentRoot "/usr/local/var/www"
  * LoadModule rewrite_module lib/httpd/modules/mod_rewrite.so
  * ServerName localhost
* 重開 Apache `sudo apachectl -k restart`

### 安裝各版本的 PHP

重新安裝記得 unlink 然後是下 reinstall 安裝 php，安裝會比較久別擔心。

* 安裝 5.6 `brew install php56 --with-httpd`
* 先移除 5.6 設定 `brew unlink php56`
* 安裝 7.0 `brew install php70 --with-httpd`
* 先移除 7.0 設定 `brew unlink php70`
* 安裝 7.1 `brew install php71 --with-httpd`

可以順便安裝相關套件如 mcrypt、imagick、redis，各版本指令如下：

* 5.6 版本 `brew install php56-mcrypt php56-imagick php56-redis`
* 7.0 版本 `brew install php70-mcrypt php70-imagick php70-redis`
* 7.1 版本 `brew install php71-mcrypt php71-imagick php71-redis`

各版本的 php.ini 分別在：

* 5.6 版本 `/usr/local/etc/php/5.6/php.ini`
* 7.0 版本 `/usr/local/etc/php/7.0/php.ini`
* 7.1 版本 `/usr/local/etc/php/7.1/php.ini`

### 更改 CLI 的 php 版本，以下以更改 5.6 為例

* 因最後一個 install 的是 7.1 所以記得移除 `brew unlink php71`
* 改使用 5.6 `brew link php56`

※ 注意！這裡只有改到 cli 部分，Apache 還沒改掉所以 phpinfo 出來應該還是 7.1


### 更改 Apache 的 php 版本

以下以更改 5.6 為例

打開編輯 `/usr/local/etc/httpd/httpd.conf` 會發現多出如下：

```
LoadModule php5_module /usr/local/Cellar/php56/5.6.31_7/libexec/apache2/libphp5.so
LoadModule php7_module /usr/local/Cellar/php70/7.0.24_16/libexec/apache2/libphp7.so
LoadModule php7_module /usr/local/Cellar/php71/7.1.10_21/libexec/apache2/libphp7.so
```

將其改成

```
LoadModule php5_module /usr/local/opt/php56/libexec/apache2/libphp5.so
LoadModule php7_module /usr/local/opt/php70/libexec/apache2/libphp7.so
LoadModule php7_module /usr/local/opt/php71/libexec/apache2/libphp7.so
```

但只能一個，因為要以 5.6 為例子，所以其他註解起來

```
LoadModule php5_module /usr/local/opt/php56/libexec/apache2/libphp5.so
#LoadModule php7_module /usr/local/opt/php70/libexec/apache2/libphp7.so
#LoadModule php7_module /usr/local/opt/php71/libexec/apache2/libphp7.so
```

※ 注意！這裡改的是 Apache 部分，CLI 則不是這樣改的～

接著把

```
<IfModule dir_module>
 DirectoryIndex index.html
</IfModule>
```

改成

```
<IfModule dir_module>
 DirectoryIndex index.php index.html
</IfModule>
<FilesMatch \.php$>
 SetHandler application/x-httpd-php
</FilesMatch>
```

然後重該 Apache `sudo apachectl -k restop`


### 版本切換工具

因版本切換時，因為都要先 unlink 再 line 太麻煩，而且還有分 CLI 與 Apache 的更改兩步驟，所以可以使用 sphp 來快速解決這問題。

* 安裝 `curl -L https://gist.github.com/w00fz/142b6b19750ea6979137b963df959d11/raw > /usr/local/bin/sphp`
* 更改權限 `chmod +x /usr/local/bin/sphp`
* 安裝好後 `echo $PATH` 看一下有無 **sphp**
* 舉例，終端機直個打 sphp 就可以列出可用的 php 版本，而切換 70 版本則 `sphp 70`

### 筆記

* 新的 Apache conf 位置 `/usr/local/etc/httpd/httpd.conf`
* 新的 Apache vhosts 位置 `/usr/local/etc/httpd/extra/httpd-vhosts.conf`
* Apache 開啟 `sudo apachectl start`
* Apache 關閉 `sudo apachectl stop`
* Apache 重開 `sudo apachectl -k restart`

### 相關參考
* [macOS 10.13 High Sierra Apache Setup: Multiple PHP Versions | Grav](https://getgrav.org/blog/macos-sierra-apache-multiple-php-versions)

`#macOS` `#Apache` `#PHP`