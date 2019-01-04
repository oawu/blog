# LINE TW TechPulse 2017

這次意外的有抽到 [LINE](https://line.me/) 的年度開發者大會，所以來寫點心得與筆記吧！

| 時間 | 主題 | 講者 3 |
| -------- | -------- | -------- |
| 09:30~09:50 | 開場致詞 | Marco Chen |
| 09:50~10:10 | Messaging API 新功能 | Charlotte Yu |
| 10:10~10:30 | 不可不知的聊天機器人開發小撇步 | Augustin Wang |
| 10:30~10:40 | 休息時間 | |
| 10:40~11:10 | LINE Things – LINE物聯網應用平台 | Joseluis Takahashi |
| 11:10~11:30 | LINE Square and Chatapp | Kevin Luo |
| 11:30~11:50 | In-App Web Framework | George Duan |
| 11:50~13:10 | 午餐時間 | |
| 13:10~13:40 | The Magic of LINE QA Testing – 讓測試更有效率的魔法 | Edward Chen |
| 13:40~14:10 | LINE TODAY - 架一個高流量、高效能的網站 | CJ Tu |
| 14:10~14:40 | LINE NOW - LINE聊天機器人在實體活動的應用 | Shawn Tsai |
| 14:40~15:10 | 休息時間 | |
| 15:10~15:40 | LINE 電商 – 合作與串接模式 | Ange Wei |
| 15:40~16:30 | 開創新商機：技術合作夥伴計畫 | Benny Wu |
| 16:30~17:15 | 交流派對 | |



## 開場致詞
*  講者 Marco Chen
*  今日重點
    * 分享最新 API
    * 實際案例激發想法
    * 分享經驗(LINE NOW、EC、BOT)
    * 如何做出更好的 BOT 應用
* Clova
    * 把自己化身平台，把服務整合到 LINE
    * Clova 是一個 AI 平台
    * 目前 CUI、GUI 下階段 IOT
    * GUI 
        * LINE Today 整合了多樣平台
        * 目前發現客戶都是著重 UI
    * CUI 
        * 回歸人類本質，喜歡用問的
        * User 喜歡在 PC 上購物，Mobile 則是詢問
        * Focus on Content
        * 符合人性、自然
    * 使用體驗、經驗(User Experience)
    * LINE 就是對話式應用，改善用戶體驗、提升對話式的應用
    * Message API 很多人使用了
    * Clova 讓開發者更方便開發 AI 的服務
    * 2018 年初開放
* LINE Things 物聯網系統
    * 有 Clova AI 系統、又有物聯網，所以讓開發者 更專心在開發

## Messaging API 新功能
* 講者 Charlotte Yu
* 目前可以取得好友列表、對話內容..等
* 問題
    * 找不出有用的族群、我不知道這人是誰
    * 可以知道 User 在哪個群組說了哪些、貼圖(根本是搜集個資！？)
* Friendship status
    * 知道跟朋友的關係，知道此用戶是否為好友之類的
* Flexible rich menu api（機器人下方選單）
    * 從四格變六格
    * Keyboard UX 調整
* Switcher API
    * 目前掛一個服務的後端，未來可有不同的後端
    * 所以未來 AI 若不能回答問題時，可以轉客服，甚至不同層級的客服
* 廣告新功能
    * 使用加入官方帳號，且同意需要權限，避免掉個資問題
    * 由廣告商自行蒐集使用者行為、推銷廣告


## 不可不知的聊天機器人開發小撇步
* 講者 Augustin Wang
* SSO - Login Session Enable
    * 只要在同一個瀏覽器登入的話，就不用再輸入帳密
    * 手機上可以做登出瀏覽器（取消授權的概念）
    * Identity Auth + OAuth2 = OpenID
    * LINE Login 2.0 TWO MAJOR API FAMILIES (Login & Profile + Messaging API)
* LINE 聊天機器人
    * 10個常見問題
        1. https 問題，憑證問題。
        2. X-LINE-SIGNATURE 驗證來源是否為 line
        3. 等待回應的 Timeout 問題： slow：5s、timeoue：10s
        4. Message 是 Array 格式，這個我超有感，但我有注意到ＸＤ
        5. LINE User ID，正規格式 ^U[0-9A-F]{32}$，不同服務不同 User ID
        6. Reply 回應時間會有時效性，token 為一次性使用
        7. Template Message 步驟問題，因為流程關係，若使用這沒按照步驟走，就會有問題
        8. Line 不會幫你做 URL Cache，所以自己的 Server 自己維護
        9. API 限制，每分鐘 1萬次，每分鐘可收件人數 20萬人
        10. 學最快的地方 LINE SDK 請上 LINE GitHub [http://github.com/line](http://github.com/line)
    
## LINE Things – LINE 物聯網應用平台
* 講者 Joseluis Takahashi
* 英文 GG

## LINE Square and Chatapp
* 講者 Kevin Luo
* 群組問題 (我猜權限管控？)
    * 翻群
    * 人數限制
    * 管理方式
    * 貼文格式
* Line Square
* 新功能
    * 更多使用者
    * 管理
    * 貼文
    * 管理多個聊天室
    * 隱私
    * 訊息搜尋及保存
* 講架構
    * 實心圓(管理權限)、虛心圓(開放權限)
    * 底下會有主聊天室，所有成員皆可加入。且可另外新增其他聊天室
    * 概念就像在聊天室往上提一層，類似聊天頻道的概念
* 管理員模式
    * 最高、管理、一般
    * 移除成員需管理者權限，從聊天室中除除或是由Square中移除等
* 公司角度步驟
    1. Square 加入後的一些 Info
    2. 選類別等設定
    3. 建立各個聊天室，每個聊天室上限5000人
    4. 邀請的部分可以用 QR 或 Url 方式散播
    5. 權限管控，可以給予不同成員權限
    
      > 反正就是很強大很多功能，然後 DEMO
    
* 預計加入語音會議、影像會議、直播、TIMELINE
* 遇到的問題
    * 後端伺服器 Single Queue、Long Polling

      > Long Polling 不是古早的網頁聊天室技術嗎？

    * 不斷回去問後端，所以浪費頻寬（因為常連線）
    * Subscribe & PUSH & GET (修正方式)
* ChatApp
    * 輔助在聊天室的工具
    * 送禮物、挑日子之後會叫計程車啊～不拉不拉的所以，要整合（概念將向 iMessage 的 App 的概念？）
    * 所以在聊天中有很多功能 APP 啦

      > 這個 iMessage 與 Facebook Message 都有做了


## In-App Web Framework
* 講者 George Duan

  > 他想講，我們要統一開發 APP 的選擇！所以請選擇我們！

* 講解 Native App 上架流程會遇到的問題
* 講解 Web IN App 的便利性
    * Share UI 可直接使用已制定好的 UI
    * Web App 可以開發一份後，發布在多個平台
    * 已經有很多人在用了，所以這是我們的優勢！ 台灣有一千八百萬(UUID)

      > 養出這個環境圈，也是想綁著你們的用戶啊ＸＤ

* Chat Web App
    * 基本的 Web 前端都可以支援
    * 設計可以調整 view size，combar、tall、full、cover，Tabel tar 也可以被設定
* 要引入 JS、CSS SDK 提供給 LINE 即可
* JavaScript Event
* 與 Native App 互動架構
* Access Token
    * Get User Info
    * Send Message
* 未來會盡量與 Messsage API 相符的 Template
* Line TV
    * 就是用 Chat Web 做的
    * 可以播放影片
    * 分享影片


## The Magic of LINE QA Testing – 讓測試更有效率的魔法
* 講者 Edward Chen
* 台灣測試上特別有自動化
* 專案流程從 plan code build test... 等，測試都是不可或缺的步驟
* 連回應時間都會測試
* 流量測試，這邊不是指壓力測試，而是 PV(Page View) 的追蹤
* 魔術細節
    * Unit Test，Real、Bata 環境都會測
    * Jira
    * TestRail
    * Dockerize
    * Log 可視化
    * Video 紀錄
* 效率上升 200%
    * 透過 Docker...等方式
    * 從 2 小時縮小到 45 分鐘
* 生產力上升 10%
    * 因為時間縮短，所以可利用時間變多了
* 工具很多，要如何串連
* 測試很重要！測試很重要！測試很重要！



## LINE TODAY - 架一個高流量、高效能的網站
* 講者 CJ Tu
* What is Line Today
* 100 million MAU
* 5 Billion  MPV
* 1929/s | 600kb / 300 ms | < 10 Server
* CDN

  > CDN 應該很多人都知道了吧？

* CDN Dynamic 下的狀況
    * User <---> CDN node <--- Lots of TCP Tweaks ---> CDN node <---> Origin
* Static & Dynamic
    * CDN Dynamic 很貴，會淹死你！
    * 所以 Dynamic 用貴的，Static 用便宜的
    * 靠 DNS(Domain Name Server) 來導
* Traditional Dynamic Page
    * Pr-composer
    * 把所有新聞頁面每分鐘畫一次再丟到 Cache
    * 留言還是靠 xHr...
* Cache Every where

  > 跟我想的架構一樣呀！ 以為有特別的技巧ＱＱ 😢



## LINE NOW - LINE聊天機器人在實體活動的應用
* 講者 Shawn Tsai
* 實體活動特徵，限時、限地、實際人力……等
* 什麼是聊天機器人？
    * 最近很紅
    * 有別於以往的網頁，是一種對話式的服務
    * 複雜的語言處理，主要瞭解對方的意圖，甚至取得資源
* 以今日活動為例子
    1. GPS 藍芽
    2. 聊天室認證
    3. 加入好友
    4. 參加活動體驗

      > 可是今天排隊入場的情況有點糟啊…

* 案例
    * 婚禮 - 主人與賓客，婚紗貼圖
    * 派對 - 猜謎、遊戲、與賓客互動
    * 實體店面促銷
* 一個活動常見的三個元素
    * 場合
    * 遊戲
    * 產品
* 為何必須選擇聊天 BOT
    * 普及高
    * 使用者介面熟悉度高(好上手)
    * 新的互動型式
* 我們如何做到與克服問題
    * 希望使用者簡化步驟(體驗！！)
    * Template Message 多媒體方式(視覺化處理：圖片、卡片式)
    * LINE Beacon
* 我們希望使用者可以再回來使用
    * 利用外部資源轉化成可用資訊
    * 但越多資源要花的資源也相對越多
* 經驗分享
    1. 處理初步進來的訊息
    2. 因為太多會變慢，所以用非同步
    3. 將非同步資料存在 Queue 來依序處理
    4. 當有異常時也能適當重置或友善回應
    5. 分散式、最小單元、流動處理，讓資源可以重複利用
* 切割系統，抽象化每個子服務目標，確保每個子服務能獨立運作
* 開發視覺化工具
* 聊天機器人對實體活動產生的影響
    * 即時的回應
    * 影像化或語音化的訊息
    * 回應可以讓大家都看到，產生更多的互動
* 聊天機器人帶來的使用者體驗
    * 一致的使用者體驗
    * 單一、統一的溝通窗口



## LINE 電商 – 合作與串接模式
* 講者 Ange Wei
* LINE 也搞 EC
    * Giftshop（禮品小舖）
    * Commerce（口袋商站）
    * Line Shopping （未上線服務）
* Giftshop
    * 串接電子發票
    * 可用 LinePay 付帳 或 LineCoins 折抵
    * 可贈送禮品給朋友
* Commerce
    * 支援超商取貨
    * 與 Giftshop 差異！？
    * 賣場的概念，商家可以申請上架
    * 成交手續費也與 Giftshop 不同
* LINE SHOPPING
    * 沒有商家上架的動作
    * 搜集所有商家商品，並比價
    * 若是合作夥伴，也會有優惠之類的
    * 之後會取代 Commerce，但 Commerce 並不會消失，而是變成商家之一
* 簡介 LINE SHOPPING 操作功能
* 工程師扮演什麼角色
    * 主要是韓國日本在開發
    * 台灣工程師主要在地化
    * 依據在的需求開發
* 超商取貨，第一個在台灣在地化功能
    * 韓國日本未必懂台灣的取貨系統
    * 於是台灣當第三方包成一個系統已提供其他國家使用
    * 口袋商店，與超商串接中
* 電子發票
    * 台灣政府極力推行
    * 日本、韓國還沒有的
    * 我們一向包成一個系統
    * 跟 Agency 合作來串接政府平台
* 問題
    * 每個超商出貨單定義不統一
    * 更新方式不同
    * 多個系統整合：Line系統、在地化系統、Partner系統
    * 溝通，UML 畫出架構與圖示，同事更新技術文件
* 因應需求建新系統
    * 例如活動，建立了許多重複的 Event Page
    * 所以工程師就建立了「活動建立」系統 ，Event PlatformEvent Platform
    * 可以讓操作人員自己去建立
    * 所以工程師輕鬆很多
* 高併發流量問題
    * 丟到 Queue
    * Worker 拿出來處理
    * Worker 拆開兩組機器
    * 加入 Redis 擋流量
    * 前端 CDN 記得注意設定時間，Case by Case
    * 規則擋住流量，例如一分鐘一次
    * 壓力測試，不同於一般，我們直接去打 BOT 或直接對 DB 打測試
* 常收到困擾訊息
    * 未來會加入分析推薦
* 聊天機器人
    * 藉由聊天瞭解客戶，並推薦商品
    * 這在日本的 Lawson 有被實現的(Rinna 機器人)
    * 印尼官方帳號，Jemma 機器人，女性品牌，最高聊到 2小時，甚至高達 78% 的推薦使用率
* 跟不同國家合作
    * 視覺化的方式顯示在地的特色
    * 盡量減少人工作業
* 上線前的壓力測試


## 開創新商機：技術合作夥伴計畫
* 講者 Benny Wu
* 他們是 API 相關的規劃
* 平台生態圈
    * 最重要的角色 - 開發者
    * 今年有很多大量 Chat BOT 的應用
    * 企業、新創、個人各種不同開發者
* 不同角色的開發者
    * 提供不同的應用
    * 新創事業需求：最想做的是知道使用者的相關訊息
    * 解決方案需求：最大困擾是大家感興趣，但客戶在哪
    * 系統整合需求：怎樣才能拿到最新技術做出最新的東西
* 今年 BOT 有哪些好玩東西
    * 微股力 - 台股大數據
        * 幫助更多人瞭解理財
        * 今年初才上架，目前累積 1,000 多用戶，80% 留存
        * DEMO 影片
        * 頻繁推播會被封鎖
    * TaxiGo
        * 有小禮物
        * 有很多司機加入四千多的司機，六萬用戶，每天上千單
        * 可以定位
        * 但概念真的不錯用在 line 上
        * 可以定位 可以分配
        * 可以綁信用卡 or line pay 直接付款
    * ChuMe(啾咪)
        * 訂飲料
        * 一樣是因為LINE普及，所以減少學習成本
        * 藉由機器人整理清單、聯絡店家
        * 轉換率 21%，回購率 52%
    * Telexpress(網訊電通)
        * 介紹自己公司
        * 客服起家
        * 社群商務平台
        * 諮詢、服務、導購
        * 一對一顧問、社群導購
        * 阿瘦皮鞋案例
        * 粉絲數：兩萬五、一對一綁定：一萬五、一對一互動：十萬
		 * 其實我聽不懂這家在做什麼的 >"<
    * FANSbee(知識科技)
        * 提供中小企業解決電子商務方案
        * 隨拍隨傳
        * 自己做了鍵盤
        * 應用在商店、食物、美甲
        * 一對一對談
* 起源、想解決的問題
    * 客戶在哪？
    * 技術怕落後
    * 沒有名氣
* 加入 Technical Partner Program 後
    * LINE 會提供相關資訊
    * LINE 會提早提供 API 相關文件
    * LINE 會邀請您來分享您成功的經驗

  > 為啥不給個 LINE 認證機制，給個徽章或證書不就好了！？

* 根據不同場景，我們會分享之前的經驗給您

  > 簡單說，來吧，我們會輔導你成功啦！

* 個人：LINE API Expert
    * 會最快拿到最新的技術
    * 有機會跟 LINE 一起交流
    * 有機會跟 CTO 聊天

      > 那也要是你有發現不錯的商業模式 CTO 才會找你吧ＸＤ

`#LINE` `#Note`