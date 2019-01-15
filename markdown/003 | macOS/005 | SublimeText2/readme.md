知名的文字編輯器，原本個人喜歡使用 Sublime Text 2，但是因為很多 Packages 已經不太支援 2 所以以下兩種都會介紹，但推薦還是使用 SublimeText 3 喔！以下介紹安裝以及使用相關的 Packages。

# macOS 上安裝 Sublime Text 文字編輯器

## Sublime Text 3
* 官網下載 - [https://www.sublimetext.com/3](https://www.sublimetext.com/3)
* 下載來後，就移到**應用程式資料夾**，並開啟

### 啟用 Packages
* 官方網站介紹 - [https://packagecontrol.io/installation#st3](https://packagecontrol.io/installation#st3)
* 打開 Sublime Text，按下 ctrl + `
* 輸入官網給的那串文字 `import urllib.request,os,hashl...` 的(請至官網複製)，然後重開 Sublime Text

### 安裝套件
* SublimeLinter
	* 打開 Sublime Text，按下 `command + shift + p`
	* 輸入 `install` 選擇 `Package Control: Install Package`
	* 接著輸入 `SublimeLinter`，選擇 `SublimeLinter`
	* 重新開啟 Sublime Text

* SCSS
	* 打開 Sublime Text，按下 `command + shift + p`
	* 輸入 `install` 選擇 `Package Control: Install Package`
	* 接著輸入 `SCSS`，選擇 `SCSS`
	* 重新開啟 Sublime Text

### 環境設定
* 開啟 Sublime Text，點擊左上 `Sublime Text` > `preferences` > `Browser Packages..` 後出現一個資料夾
* 進入資料夾 `User`
* 下載 [Preferences.sublime-settings](https://cdn.ioa.tw/MacEnvInit/Preferences.sublime-settings)
* 將下載的檔案複製到 `User` 資料夾，將原本的 `Preferences.sublime-settings` 取代

### 快捷鍵設定
* 開啟 Sublime Text，點擊左上 `Sublime Text` > `preferences` > `Browser Packages..` 後出現一個資料夾
* 進入資料夾 `User`
* 下載 [Default (OSX).sublime-keymap](https://cdn.ioa.tw/MacEnvInit/Default+(OSX).sublime-keymap)
* 注意！下載下來的檔案是 `Default+(OSX).sublime-keymap`，記得把中間的 `+` 改為 `空格`
* 將下載的檔案複製到 `User` 資料夾

### 安裝指令  
* 打開 `iTerm2` 終端機(若尚未安裝 `iTerm2` 請先參考 [此篇](../009 | iTerm2) 安裝)，建立 bin 目錄執行指令 `mkdir ~/bin`
* 打開終端機，輸入指令 `ln -s /Applications/Sublime\ Text.app/Contents/SharedSupport/bin/subl  ~/bin/subl`
* 打開 Finder，然後快捷鍵 `command + shift + g` 輸入 `~/.zshrc`，拖曳至 Sublime Text 編輯
* 在檔案最下面新增 `export PATH=$PATH:$HOME/bin`







## Sublime Text 2
目前官方好像不太支援，反正可以的話就用 3 試試看吧！

* 官網下載 - [https://www.sublimetext.com/2](https://www.sublimetext.com/2)
* 把它移到**應用程式資料夾**，並開啟

### 啟用 Packages  
* 網站介紹 - [https://packagecontrol.io/installation#st2](https://packagecontrol.io/installation#st2)
* 打開 Sublime Text 2，按下 ctrl + `
* 輸入官網給的那串文字 `import urllib2,os,hashl...` 的(請至官網複製)，然後重開 Sublime Text 2

### 安裝套件
* SublimeLinter
	* 打開 Sublime Text 2，按下 `command + shift + p`
	* 輸入 `install` 選擇 `Package Control: Install Package`
	* 接著輸入 `SublimeLinter`，選擇 `SublimeLinter`
	* 重新開啟 Sublime Text 2

* Scss
	* 打開 Sublime Text 2，按下 `command + shift + p`
	* 輸入 `install` 選擇 `Package Control: Install Package`
	* 接著輸入 `SCSS`，選擇 `SCSS`
	* 重新開啟 Sublime Text 2

### 主題
* 下載 [OA.tmTheme](https://cdn.ioa.tw/MacEnvInit/OA.tmTheme) 與 [Theme - OA.zip](https://cdn.ioa.tw/MacEnvInit/Theme - OA.zip)
* 將 **Theme - OA.zip** 解開壓縮，
* 點擊左上 `Sublime Text 2` > `preferences` > `Browser Packages..` 後出現一個資料夾
* 將資料夾 **Theme - OA** 複製到這個資料夾內(沒意外會在 Theme - Default 下面)
* 將 **OA.tmTheme** 複製到 `Color Scheme - Default` 裡面

### 環境設定
* 點擊左上 `Sublime Text 2` > `preferences` > `Browser Packages..` 後出現一個資料夾
* 進入資料夾 `User`
* 下載 [Preferences.sublime-settings](https://cdn.ioa.tw/MacEnvInit/Preferences.sublime-settings)
* 將下載的檔案複製到 `User` 資料夾，將原本的 `Preferences.sublime-settings` 取代

### 快捷鍵設定
* 點擊左上 `Sublime Text 2` > `preferences` > `Browser Packages..` 後出現一個資料夾
* 進入資料夾 `User`
* 下載 [Default (OSX).sublime-keymap](https://cdn.ioa.tw/MacEnvInit/Default+(OSX).sublime-keymap)
* 注意！下載下來的檔案是 `Default+(OSX).sublime-keymap`，記得把中間的 `+` 改為 `空格`
* 將下載的檔案複製到 `User` 資料夾，將原本的 `Default (OSX).sublime-keymap` 取代

### 安裝指令  
* 打開 `iTerm2` 終端機(若尚未安裝 `iTerm2` 請先參考 [此篇](../009 | iTerm2) 安裝)，建立 bin 目錄執行指令 `mkdir ~/bin`
* 打開終端機，輸入指令 `ln -s /Applications/Sublime Text 2.app/Contents/SharedSupport/bin/subl ~/bin/subl`
* 用 Sublime Text 2 打開編輯 `~/.zshrc`
* 在檔案最下面新增 `export PATH=$PATH:$HOME/bin`



## 授權
* 打開 Gmail，搜尋 `sublime license`，複製授權碼
* 點擊上方 `Help` > `Enter License`，貼上授權碼

## 相關參考
* 安裝指令參考 [https://gist.github.com/barnes7td/3804534](https://gist.github.com/barnes7td/3804534)


`#Sublime` `#文字編輯` `#寫程式`
