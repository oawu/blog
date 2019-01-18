iOS 的開發者應該常會使用到 CocoaPods 來做套件管理，以下是安裝步驟。

# macOS 上安裝 CocoaPods iOS 套件管理
* 終端機執行指令 `sudo gem install cocoapods`，會有點久，別緊張 😉
* 檢查是否安裝成功，重新開啟終端機，執行指令 `pod --version`

## 初始化專案
* 在專案目錄下，終端機執行指令 `pod init`

## 範例
* 安裝 **AlamofireObjectMapper**，在專案下 **Podfile** 加入 `pod 'AlamofireObjectMapper', '~> 5.0'`
* 執行 `pod install`，第一次會很久
* 原本應該開啟 .xcodeproj 改開啟 **.xcworkspace**

### 相關參考
* [https://cocoapods.org/](https://cocoapods.org/)

`#iOS` `#Xcode` `#CocoaPods` `#App`