### 說明
這是最近在玩 ruby on rails 的安裝心得，因為一直安裝失敗，於是我只好重灌電腦並且完整的重新安裝與記錄！

<br/>
### 規格
* 作業系統 Mac OS x 10.9.5

<br/>
### 系統
* 更新 OSX。  
	![update os](./img/01.png)

* 下載 & 更新 Xcode。  
	![update xcode](./img/02.png)

<br/>
### 步驟
* 安裝 homebrew 可以參考[這篇](mac os 安裝 homebrew.html)。

* 安裝 XQuartz。
	* 安裝 ImageMagick 需先有 X11 的 support,OSX 10.8 拿掉了..，[載點](http://xquartz.macosforge.org/landing)。
	* 它是 **.dmg** 檔案，基本上就是下一步、下一步的安裝就可以，安裝完後重開。

		![install XQuartz](./img/08.png =300x)

* 安裝 ImageMagick ```brew install imagemagick```。  
	![brew install imagemagick](./img/09.png)

* 安裝 MySQL 可以參考[這篇](mac os 安裝 mysql.html)。

* 安裝 [RVM](https://rvm.io/)

	* 參考 [https://rvm.io/rvm/install/](https://rvm.io/rvm/install/)，輸入指令: ```curl -L https://get.rvm.io | bash -s stable```。  
		![install rvm](./img/17.png)

	* 檢查是否安裝成功，重新開啟 iTerm，輸入 ```rvm -v```。  
		![check rvm](./img/18.png)

	* 若尚未安裝 [oh my zsh](https://github.com/robbyrussell/oh-my-zsh)[^1] 就執行指令	: ```echo '[[ -s "$HOME/.rvm/scripts/rvm" ]] && . "$HOME/.rvm/scripts/rvm" # Load RVM function' >> ~/.bash_profile```。

	* 若安裝 rvm 後才安裝 [oh my zsh](https://github.com/robbyrussell/oh-my-zsh) 就執行: ```echo '[[ -s "$HOME/.rvm/scripts/rvm" ]] && . "$HOME/.rvm/scripts/rvm" # Load RVM function' >> ~/.zshrc```。

	* 若指定預設 ruby 版本時出現權限問題可以這樣做，輸入指令: ```suod chown xxx:root /usr/local/bin #xxx 是你的user```。

> rvm 使用[範例](http://beginrescueend.com/rvm/basics/)
>
	  rvm list                      # 列出電腦中已經安裝的 ruby 版本
	  rvm list known                # 列出所有可安裝的 ruby 版本
	  rvm ruby-1.8.7-p334           # 切換ruby 版本到 ruby-1.8.7-p334
	  rvm ruby-1.8.7-p334 --default # 設定 ruby-1.8.7-p334 為預設的版本
	  rvm install ruby-1.8.7-p334   # 安裝 ruby-1.8.7-p334

* 安裝 [ruby](https://www.ruby-lang.org/zh_tw/)
	* 首先使用 rvm 列出可以安裝的 ruby 版本，指令: `rvm list known`。  
		![rvm list known](./img/19.png)

	* 安裝 2.1.3，指令: `rvm install 2.1.3`。  
		![rvm install 2.1.3](./img/20.png)

	* 測試是否安裝成功，指令: `ruby -v`。  
		![ruby -v](./img/21.png)

> 若有出現 readline.c 的錯誤時，可以試著以下指令: 
>
	rvm package install readline
	# 然後在安裝指令的後面加上 -C --with-readline-dir=$rvm_path/usr
	rvm install 1.9.3 -C --with-readline-dir=$rvm_path/usr

* 安裝 gem
	* 指令: `rvm rubygems current`。  
		![rvm rubygems current](./img/22.png)

	* 檢查是否安裝成功，指令: `gem -v`。  
		![gem -v](./img/23.png)

	* 設定 ```--no-ri --no-rdoc``` 的參數，一般安裝 gem 也會同時安裝該 gem 的文件，但通常這些文件都是在網路上看的，因此不需要浪費空間和時間安裝在自己的電腦。
	
		```
	vim ~/.gemrc   # 打開 ~/.gemrc
	# 加上以下後, 存檔重新登入命令列即可
	gem: --no-ri --no-rdoc
```

* 安裝 bundler

	* 指令[^2]: ```gem install bundler --no-ri --no-rdoc```。  
		![gem install bundler](./img/24.png)

* 安裝 rails

	* 如果是要安裝目前最穩定版本，指令: `gem install rails --no-ri --no-rdoc`。  
		![gem install rails](./img/25.png)

	* 檢查是否安裝成功，指令: `rails -v`。  
		![rails -v](./img/26.png)

	* 如果是要安裝特別版本，指令: ```gem install rails -v=3.2.8 --no-ri --no-rdoc```。

<br/>
### 以上參考
* Rails 101 - [https://readmoo.com/book/210010467000101](https://readmoo.com/book/210010467000101)
* 五樓專業團隊 - [http://pm.5fpro.com/projects/public-wiki/wiki/MaxOS_-_Ruby_on_Rails](http://pm.5fpro.com/projects/public-wiki/wiki/MaxOS_-_Ruby_on_Rails)


[^1]: 一般新的 mac 都不會安裝 oh my zsh。
[^2]: 若已經有設定 ```--no-ri --no-rdoc``` 為預設參數，則就不需要再加上 ```--no-ri --no-rdoc```。