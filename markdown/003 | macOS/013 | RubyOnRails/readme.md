在 macOS 作業系統上安裝 Ruby on Rails，並且依序安裝 RVM、Ruby、RubyGems、Rails.. 等。

# macOS 上安裝 Ruby on Rails
## Youtube 影音教學版
* [https://www.youtube.com/watch?v=sQ5WyNwGhuE](https://www.youtube.com/watch?v=sQ5WyNwGhuE)

## 安裝之前
* 更新 macOS，點選左上角 `` > `關於這台 Mac` > `軟體更新...`
* 安裝更新 `xcode`

## 安裝 RVM
* 官方網站 - [https://rvm.io/](https://rvm.io/)
* 終端機執行指令 `curl -L https://get.rvm.io | bash -s stable`
* 檢查是否安裝成功，重新開啟終端機，執行指令 `rvm -v`

## RVM 使用範例  
```
rvm list                      # 列出電腦中已經安裝的 ruby 版本  
rvm list known                # 列出所有可安裝的 ruby 版本  
rvm ruby-1.8.7-p334           # 切換ruby 版本到 ruby-1.8.7-p334  
rvm ruby-1.8.7-p334 --default # 設定 ruby-1.8.7-p334 為預設的版本  
rvm install ruby-1.8.7-p334   # 安裝 ruby-1.8.7-p334
```

## 安裝 Ruby
* 官方網站 - [https://www.ruby-lang.org/zh_tw/](https://www.ruby-lang.org/zh_tw/)
* 列出可以安裝的 Ruby 版本 `rvm list known`，按 `q` 可以離開
* 安裝 2.5.3 終端機執行指令 `rvm install 2.5.3`，這邊可能會有點久，別緊張 😉
* 檢查是否安裝成功，重新開啟終端機，執行指令 `ruby -v`
* 若有出現 readline.c 的錯誤時，可以試著以下指令:

```
rvm package install readline
rvm install 2.5.3 -C --with-readline-dir=$rvm_path/usr
```

## 安裝 RubyGems
* 官方網站 - [https://rubygems.org/](https://rubygems.org/)
* 安裝最新版本，終端機執行指令 `rvm rubygems current`
* 檢查是否安裝成功，重新開啟終端機，執行指令 `gem -v`
* 設定 `--no-ri --no-rdoc` 的參數，一般安裝 gem 也會同時安裝該 gem 的文件，但通常這些文件都是在網路上看的，因此不需要浪費空間和時間安裝在自己的電腦。

```
vim ~/.gemrc   # 打開 ~/.gemrc
# 加上以下後, 存檔重新登入命令列即可
gem: --no-ri --no-rdoc
```

## 安裝 Bundler
* 終端機執行指令 `gem install bundler --no-ri --no-rdoc`，這邊也可能會有點久，別緊張 😉
* 若有發生 `Unable to require openssl, install OpenSSL and rebuild Ruby (preferred) or use non-HTTPS sources` 錯誤，那就先執行 `brew install openssl` 完後，重裝 ruby 並加入參數 ` --with-openssl-dir`，終端機執行指令 `rvm reinstall 2.5.3 --with-openssl-dir=/usr/local/opt/openssl`

> 若已經有設定 --no-ri --no-rdoc 為預設參數，則就不需要再加上 --no-ri --no-rdoc

## 安裝 Rails
* 如果是要安裝目前最穩定版本，終端機執行指令 `gem install rails --no-ri --no-rdoc`，這邊也可能會有點久，別緊張 😉
* 檢查是否安裝成功，重新開啟終端機，執行指令 `rails -v`

> 如果是要安裝特別版本 `gem install rails -v=3.2.8 --no-ri --no-rdoc`

### 相關參考
* RVM - https://rvm.io/rvm/install/
* Rails 101 - https://readmoo.com/book/210010467000101
* 五樓專業團隊 - http://pm.5fpro.com/projects/public-wiki/wiki/MaxOS_-_Ruby_on_Rails

`#Ruby` `#Rails` `#Ruby on Rails` `#後端`
