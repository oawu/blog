OA 個人的 macOS 環境配置與操作習慣設定。

# 設定 Xcode 與基礎環境
* 環境 macOS MoJave 10.14.2
* 這一版本的主要特色就是桌布會隨時間改變，並且有黑主題ＸＤ

## App Store
* 重新設定國籍  
* 下載安裝 Xcode - [https://itunes.apple.com/tw/app/xcode/id497799835?mt=12](https://itunes.apple.com/tw/app/xcode/id497799835?mt=12)
	* 安裝好啟動
	* 依序步驟按同意
* 下載安裝 LunarCal - [https://itunes.apple.com/tw/app/lunarcal/id459976036?mt=12](https://itunes.apple.com/tw/app/lunarcal/id459976036?mt=12)
	* 基本選項
		* 在登入時自動開啟 `勾選` 
		* 游標停滯時自動滑出 `取消勾選` 
		* 游標離開時自動關閉 `取消勾選` 
		* 地區改為 `台灣`
		* 顯示日期與時間 `取消勾選`
* 下載安裝 Sip(Apple Store 已無販售)
	* 下拉點選齒輪
	* General
		* Number of colors in color history `取消勾選`
	* Formats
		* CSS 將 All caps `取消勾選`
		* 將不必要的類型 `取消勾選`
	* Shortcuts
		* 只留 `General` 的 `Show Magnifier`，並且設定快捷鍵為 `command + shift + e`

* 下載安裝 Line - [https://itunes.apple.com/tw/app/line/id539883307?mt=12](https://itunes.apple.com/tw/app/line/id539883307?mt=12)

## 建立截圖位置
主要就是將 `截圖` 目錄建立在 `圖片` 目錄之下，步驟如下：
* 進入圖片目錄，終端機執行指令 `cd ~/Pictures`
* 建立截圖目錄，終端機執行指令 `mkdir 截圖`
* 設定截圖儲存位置，終端機執行指令 `defaults write com.apple.screencapture location ~/Pictures/截圖`

## 建立 www 資料夾
主要就是將 www 目錄建立在 home 目錄之下，步驟如下：
* 進入 Home 目錄，終端機執行指令 `cd ~`
* 建立 www 目錄，終端機執行指令 `mkdir www`
* 變更 www 目錄權限，終端機執行指令 `chmod 777 www`

## Finder 設定
* 畫面上方 `顯示方式`
	* 開啟 `顯示標籤列`
	* 開啟 `顯示狀態列`
	* 開啟 `顯示路徑列`
* 選用`直欄顯示`，可用快捷鍵 `command + 3` 快速設定
* 直欄設定快捷鍵 `command + j`，設定文字大小 `16`  
* 設定 `偏好設定`，可用快捷鍵 `command + ,` 開啟，然後依序設定以下：
	* 一般
		* `開啟新 Finder 視窗時顯示`，點選 `其他`，然後選 `www` 目錄(如果找不到就按 `command + shift + g`，輸入 `~` 前往，然後選擇 `www` 目錄)，這邊可以依據自己喜好決定。
	* 側邊欄
		* 只勾選以下項目，可依據自己喜好調整：
			* AirDrop
			* 應用程式
			* 桌面
			* 文件
			* 下載項目
			* 圖片
			* Home
	* 進階
		* 勾選 `顯示所有檔案副檔名`
		* `執行搜尋時`，改為 `搜尋目前的檔案夾`

## 修正 Finder 左邊喜好項目順序
* 打開 Finder，按下快捷鍵 `command + shift + g`
* 輸入 `~` 後按下前往。
* 用拖曳的方式將左邊 `喜好項目` 自定義排序
* 以下是 OA 個人喜好，僅供參考，可依據自己喜好做調整：
	* Home
	* AirDrop
	* 應用程式
	* 文件
	* 圖片
	* 下載項目
	* 截圖(在圖片裡面)
	* www
	
	
## 設定下方 Dock
* 設定下載呈現風格，可依據自己喜好做調整，步驟如下：`下載項目` > `右鍵` > `檢視內容方式` > `格狀`

## 系統偏好設定
* 一般
	* `外觀` 請依據自己喜好選擇 `淺色` 或 `深色`
	* `側邊欄圖像大小` 選擇 `大`
	* 最近使用過的項目 `無`
* Dock
	* `大小` 拉到約 `五分之一`，可依據自己需求而定
	* `勾選` 放大，並且拉到 `最大`，可依據自己需求而定
	* `勾選` 自動隱藏顯示 Dock
* 指揮中心
	* 鍵盤和滑鼠快捷鍵全部取消
* Spolight
	* 全部 `取消勾選`，因為我不常使用到它，所以可以依據自己需求而決定
* 通知
	* `勿擾模式` 當顯示器進入睡眠時 `勾選`
* 鍵盤
	* 鍵盤
		* 按鍵重複，`快`
		* 重複前暫延，`短`
	* 快速鍵
		* `啟動台與 Dock`
			* 啟用/停用隱藏 Dock `取消勾選`
			* `勾選` 顯示「啟動台」並設定快捷鍵 `F4`
		* `螢幕快照`，可依據自己習慣做修改：
			* `螢幕快照和錄影選項` 快捷鍵改為 `command + shift + 6`
			* `拷貝所選區域的圖片至剪貼簿` > 改為 `command + shift + 5`，如此一來按下這個快捷鍵就可以直接截圖然後貼上。
		* `Spolight` > 全部 `取消勾選`
		* `輔助說明` > 全部 `取消勾選`
		* `App 快速鍵`
			* `取消勾選` 顯示輔助說明選單 
			* 按 `+` > 應用程式選 `Finder` > 選單名稱輸入 `顯示上一個標籤頁`，鍵盤快捷鍵設定 `command + option + ←`
			* 按 `+` > 應用程式選 `Finder` > 選單名稱輸入 `顯示下一個標籤頁`，鍵盤快捷鍵設定 `command + option + →`
* 滑鼠
	* `取消勾選` 捲動方向：自然
	* 軌跡速度 `第四線`
	* 捲動速度 `第五線`
	* 按兩下的速度 `倒數第三線`
* 觸碰式軌跡版
	* 點按
		* 除了 `靜音點按` 其他都 `勾選`
		* `按一下` 拉到 `輕微`
		* `軌跡速度` 拉到 `倒數第四線`
	* 捲動與縮放
		* 只勾選 `放大或縮小`
	* 更多手勢
		* 只勾選 `在頁面之間滑動`
* iCloud
	* iCloud Driver 取消
	* 照片 取消
	* 郵件 取消
	* 聯絡資訊 `勾選`
	* 行事曆 `勾選`
	* 提醒事項 `勾選`
	* Safari 取消
	* 備忘錄 `勾選`
	* Siri 取消
	* 鑰匙圈 `勾選`
	* 返回我的 Mac 取消
	* 尋找我的 Mac `勾選`
* 藍芽
	* 在選單列中顯示藍芽 `勾選`
* 共享
	* 修改電腦名稱
* 日期與時間
	* 時鐘
		* 選擇 `數字`
		* 除了 `使用 24 小時制` 其他都 `勾選`
		* 語音報時 `取消勾選`
* 輔助說明
	* 滑鼠與觸控式軌跡板
		* `觸控式軌跡板選項` > `啟用拖移` > `三指`

## 顯示隱藏檔案
* 終端機執行指令 `defaults write com.apple.finder AppleShowAllFiles TRUE;\killall Finder`

## 關閉按住輸入重音字元
* 終端機執行指令 `defaults write -g ApplePressAndHoldEnabled -bool false`


`#macOS` `#Xcode` `#Finder` `#系統`
