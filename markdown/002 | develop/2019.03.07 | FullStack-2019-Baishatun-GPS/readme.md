# 2019 白沙屯媽祖南下進香 GPS 系統

因為每年我都會協助幫忙準備這個「白沙屯媽祖南下進香」的活動，所以今年我也在準備著，一年一次，這個專案每年這時候都會啟動，常常有人會問我，不就是把去年的資料庫清空就好了嗎？

不！因為每一年，在我的技術上都是在進步，於是回頭看去年，總會有哪麼一點點不完美的地方，執著的工程師個性，就會想要把他重寫，讓這個專案更加完美！


這個專案每年從的資訊工程幾乎都是由我完成的，以下就是這次我個人完成的項目：

* 後端程式碼 - [PHP](https://zh.wikipedia.org/zh-tw/PHP)
* [AWS](https://aws.amazon.com/tw/) 系統架設
	* [EC2](https://aws.amazon.com/tw/ec2/) - 後端伺服器
	* [RDS](https://aws.amazon.com/tw/rds/) - 資料庫
	* [S3](https://aws.amazon.com/tw/s3/) - 雲端空間
	* [CloudFront](https://aws.amazon.com/tw/cloudfront/) - CDN
	* [Certificate Manager](https://aws.amazon.com/tw/certificate-manager/) - 憑證管理
* GPS 訊號後台收集與校正
* 前端網頁地圖功能

都是一個人完成，而這次也加入了開發 iOS App，其實成就感頗高！所以這篇會著重在 iOS Swift 的學習心得，若要看其他部分也可以參考[2016 的心得](../2016.03.15 | FullStack-2016-Baishatun-GPS)！

廢話不多說。寫 App，當然是直接先給鏈結下載呀，有興趣的夥伴歡迎下載囉！

* App - [白沙屯 GPS](https://itunes.apple.com/tw/app/id1455045995)
* 網站 - [2019 白沙屯 GPS](https://gps.godmaps.tw/)
* 粉專 - [白沙屯媽祖在哪裡？](https://www.facebook.com/baishatunGPS/)

### 開發心得
回想起當初想學 App 已經是三年前了，當初還是寫 Object-C，但因為本身工作是專職的網站前後端工程師，所以一直沒有時間好好的專研，頂多就是想到就寫個小 App，了解一下推播、Watch App.. 等，但都一直沒上架過，所以就默默的繳了三年的開發者費用，這就是信仰！？（疑）

在今年，我終於上架了我第一個 App

以往這個活動我都是使用網頁技術來呈現，但是從去年開始 Google Maps 就調漲了費用、收費方式，於是不得不另尋他路改採用 App 的方式來省錢，Google Maps 官方也寫了，採用 App SDK 好像基本的地圖就可以無上限使用，所以在今年一月底，我正式開始籌備今年度的 GPS 系統！

這個系統我想對很多資深的工程師來說困難度應該不高，主要就是讀取 API 並且將內容呈現，所以對我來說幾項重點：

1. UI - Constraint
2. API - Alamofire
3. Maps - Google Maps
4. 送審 - Reject

### UI - Constraint

以 UI 來說，我有練習過 Obj-c 的經驗，應該不難，就只是語法上的差異，而我在刻板時，其實很不習慣使用 storyboard，所以我的專案內都是採用 [NSLayoutConstraint](https://developer.apple.com/documentation/uikit/nslayoutconstraint) 的方式將版型兜出來，可能是 css 切版習慣了，所以還是偏愛 Constraint 的方式來調整版型，所以自己寫了個簡單的 Lib 來使用，例如以下的方式讓我自己方便調整版型！

``` swift
OA.layout(self.view, nameView) {
    $0.at(.left, .equal, .left, 8)
    $0.at(.right, .equal, .right, 8)
    $0.at(.top, .equal, self.view.safeAreaLayoutGuide, .top, 8)
    $0.at(.height, .equal, 18)
}
```

其中包含 TableView 的 Cell 我也是這樣做，之後我還打算加入可以判斷螢幕寬高、旋轉的條件！

至於圖示，因為本身對於設計真的很外行，所以沒辦法產出我想要的 icon，但因為有網頁前端的經驗，所以很長使用 SVG 的 icon，於是使用了 [SwiftSVG](http://mchoe.github.io/SwiftSVG/) 這個套件，所以 App 中的圖示，都是採用 SVG 的方式呈現。


### API - Alamofire
API 的方式我採用 Alamofire 這個套件，因為以前 Obj-c 是使用 [AFNetworking](https://github.com/AFNetworking/AFNetworking)，上去 GitHub 看了一下，感覺他們推薦使用 [Alamofire](https://github.com/Alamofire/Alamofire)，所以這專案我採用 Alamofire，使用方式網路上很多資源，而我把它進階包了一下，因為 [closure](https://docs.swift.org/swift-book/LanguageGuide/Closures.html) 擺在後面可以直接這樣用，所以語意上好像更清楚了（？），範例如下：

``` swift
class Api {
  static var get = ApiGet()
  static var post = ApiPost()
}

class ApiGet {
  public func path(_ closure:@escaping (([String: Any]) -> Void)) {
    Alamofire.request("API", method: .get).validate().responseJSON { response in
        switch response.result {
        case .success(let json):
          return closure(json as! [String : Any]);
        case .failure(let error):
          // Error Func
        }
    }
  }
}

class ApiPost {
  public func path(_ closure:@escaping (([String: Any]) -> Void)) {
    // 以下省略
  }
}

Api.get.path { json in
  // 取得資料後要做的事
}
Api.post.location { json in
  // 完成 Post 後要做的事
}
```

不過我其實也想說要不要改用原生的 [NSURLConnection](https://developer.apple.com/documentation/foundation/nsurlconnection) 之類的，打造出自己的 Call Api 工具，這等之後熟一點後，在重新送一版好了ＸＤ


### Maps - Google Maps

關於地圖，其實我原本想採用原生的 [MapKit](https://developer.apple.com/documentation/mapkit)，但想到活動時，可能會有很多人不習慣 Apple Maps 的樣式，於是才依然使用 [Google Maps](https://developers.google.com/maps/documentation/ios-sdk/start)。

安裝套件方法其實 [官方文件](https://developers.google.com/maps/documentation/ios-sdk/start) 照著走就可以完成了，所以沒太大的難點，而使用方式也跟 [JavaScript](https://developers.google.com/maps/documentation/javascript/tutorial) 大同小異。

唯一比較特別的是，在我的地圖上的 Marker 都是客製的 Marker，繼承 [GMSMarker](https://developers.google.com/maps/documentation/ios-sdk/marker)，並取代其 [iconView](https://developers.google.com/maps/documentation/ios-sdk/marker#use_the_markers_iconview_property) 即可，只是在算中心點位置時要特別注意 [groundAnchor](https://developers.google.com/maps/documentation/ios-sdk/reference/interface_g_m_s_marker.html#a65c160c7a9d3aadbbfc0a9a640fa826b) 的算法。

在 Marker 的動畫上，我則練習了 [CAAnimationGroup](https://developer.apple.com/documentation/quartzcore/caanimationgroup) 的用法，並且使用 [CAMediaTimingFunction](https://developer.apple.com/documentation/quartzcore/camediatimingfunction) 來呈現動畫的效果，不過我對 iOS App 的 UI 效能還沒有很熟，所以我也不知道我的作法會不會有效能上的問題就是了ＸＤ

### 送審 - Reject

最後送審了！

其實我是按照「[iOS App 上架: 一步一腳印的新手教學和更新流程 - AppCoda](https://www.appcoda.com.tw/ios-app-submission/)」這篇的步驟完成的，以上都順利，只是還是被 Reject 了一次，但好像第一次都被 Reject 好像都是正常的ＸＤ？

被 Reject 的原因是 `Privacy - Location When In Use Usage Description` 的原因沒寫清楚，若要取得使用者的位置資訊，那你就必須寫清楚是在 App 上的哪個功能使用，我原本是寫 `讓白沙屯媽祖取得你的位置吧！` 所以就被 Reject，但改成 `若允許取用您的位置，地圖上就可以顯示您與媽祖的相對位置，並且可以查看自己所在的地點。` 就審核通過啦！

不過意外的小插曲是，第一次送審雖然被 Reject 了，不過我從 Reject 的訊息中看到 Apple 的截圖才發現我送錯版了，看到截圖中怎會有測試站的資料，才發現我在 Archive 時，沒有調整 Scheme，所以把測試版拿去送審了，不過剛好與 `Privacy - Location When In Use Usage Description` 的問題一起重新送審！


### 小結論
以上很趕，短短一個月，所以還有很多東西沒做到完美，例如：效能、有效的 Debug

以後若有開發更進階的有趣的 App 我也會再分享，文章中若有錯誤觀念或者寫法，再麻煩指正，感謝 >"<"


### 以上參考

* [https://gps.godmaps.tw/](https://gps.godmaps.tw/)
* [https://www.appcoda.com.tw/ios-app-submission/](https://www.appcoda.com.tw/ios-app-submission/)
* [https://www.appcoda.com.tw/intermediate-swift-tips/](https://www.appcoda.com.tw/intermediate-swift-tips/)
* [https://stackoverflow.com/questions/29311093/place-activity-indicator-over-uitable-view](https://stackoverflow.com/questions/29311093/place-activity-indicator-over-uitable-view)
* [http://mchoe.github.io/SwiftSVG/](http://mchoe.github.io/SwiftSVG/)
* [https://github.com/Alamofire/Alamofire](https://github.com/Alamofire/Alamofire)

`#Google Maps` `#GPS` `#白沙屯` `#媽祖` `#iOS` `#Swift` `#HUD` `#App` `#Alamofire` `#AFNetworking`