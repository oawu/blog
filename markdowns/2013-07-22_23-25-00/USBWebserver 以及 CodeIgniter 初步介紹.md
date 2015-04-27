### 說明
這篇主是要將 USB 變成行動的 Web Server，先Google一下，下載主要程式 [USBWebserver v8.5.rar](http://www.usbwebserver.net/en/download.php) 和 [CodeIgniter_2.1.3.zip](https://ellislab.com/codeigniter/user-guide/installation/downloads.html)，這兩個東西都是免費的。

<br/>
### 規格
作業系統: Windows7 or XP (其他系統我沒側試過)


<br/>
### 步驟
* USBWebserver v8.5 是一套免安裝版的 Apache + php + MySQL on USB Device!
	* 解開壓縮後，根目錄 ```./USBWebserver v8.5/8.5/root/```。
	
	* 執行檔在 ```./USBWebserver v8.5/8.5/usbwebserver.exe``` 將其啟動後，便可以使用了。
	
	* Algemeen - 選項會有一些關於 Server 的初步相關設定位置。
	
	* Apache - 選項則是可以 Start、Stop Web-Server。
	
	* MySQL - 選項則是可以 Start、Stop MySQL-Server。
	
	* Instellingen - 選項主要是設定本程式的語言、以及根目錄位置還有 Web-Server、MySQL-Server 的 Port[^1]。

* Codeigniter 是一套 **MVC架構**[^2] 的Framework 框架，解開壓縮後主要先注意幾個地方！
	* 系統開啟後網頁首頁會在 ```./CodeIgniter_2.1.3/index.php```，但點開來看內容後會發現裡面都跟顯示出來的網頁不一樣。
	
	* 首先開啟 ```./CodeIgniter_2.1.3/application/config/routes.php``` 會發現裡面有一行 ```$route['default_controller'] = "welcome";``` 便可以知道首頁是指向了welcome頁面。
	
	* 開啟 ```./CodeIgniter_2.1.3/application/controllers/welcome.php``` 這隻檔案就是 Controller 的程式。
	
	* 開啟 ```./CodeIgniter_2.1.3/application/views/welcome_message.php``` 這隻檔案就是 View 的程式。
	
	* Model 的程式則是放在 ```./CodeIgniter_2.1.3/application/models/``` 裡面，但 Welcome 的範例沒有使用的 Model 的功能所以就看不到相關檔案了。
	
	* 所以重點是 application 下面的 controllers、views、models 這三個資料夾。
 


### 小總結
對於我來說 MVC，簡單說就是一種人家做好的介在 **php邏輯判斷** 與 **html版面排版** 以及 **資料庫** 等資料處理間的工具，都以php物件的概念處理，但還是要稍微學一下，它將很多東西都包好了包含了 url處理、Database工具... 等的 Class、Function。  

相關學習可以先參考以下網頁 :  

* [http://www.codeigniter.org.tw/user_guide/index.html](http://www.codeigniter.org.tw/user_guide/index.html)
* [http://www.slideshare.net/appleboy/introduction-to-mvc-of-codeigniter-21x](http://www.slideshare.net/appleboy/introduction-to-mvc-of-codeigniter-21x)

以上我也還在學習，有興趣的話，可以看看一起分享成長，如果有誤的話歡迎指教，謝謝囉。


[^1]: 通常習慣上，會這樣設定 Web-Server Port : 80, MySQL-Server : 3306
[^2]: MVC 架構概念最主要是將網頁分成三大部分 Model、View、Controller，主要概意就是將網站拆開 邏輯、版型，好讓設計者容易維護，更多ＭVC: [http://zh.wikipedia.org/zh-tw/MVC](http://zh.wikipedia.org/zh-tw/MVC)