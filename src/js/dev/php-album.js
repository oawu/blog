/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2010-07-01')

let blocks = [
  Header(
    H1('用 PHP 實作網路相簿'),
  ),
  P(
    Span('因為大三專題有接觸網頁設計，所以就利用課餘時間開發了簡單的一套相簿系統，這套系統是使用 php 版本 5.4 開發，內容包含基本的登入、上傳、編輯..等 '),
    A('Create、Read、Update、Delete(CRUD)').href('https://zh.wikipedia.org/wiki/%E8%B3%87%E6%96%99%E6%93%8D%E7%B8%B1%E8%AA%9E%E8%A8%80'),
    Span(' 功能。')
  ),
  P(
    Span('大學時期還不知道任何的 '),
    A('Framework').href('https://zh.wikipedia.org/wiki/PHP%E6%A1%86%E6%9E%B6%E5%88%97%E8%A1%A8'),
    Span(' 於是自己製作了一套屬於自己的框架系統，並且嘗試實作出可以'),
    B('登入'),
    Span('、'),
    B('上傳圖片'),
    Span('、'),
    B('編輯圖片'),
    Span('、'),
    B('檢視線上人數'),
    Span('… 等功能，並且版型設計都一個人完成。')
  ),
  P(
    Span('此時我在這階段已經算是對於 '),
    A('PHP').href('http://php.net/'),
    Span('、'),
    A('MySQL').href('https://www.mysql.com/'),
    Span('、'),
    A('HTML').href('https://zh.wikipedia.org/zh-tw/HTML'),
    Span('、'),
    A('CSS').href('https://developer.mozilla.org/zh-TW/docs/Web/CSS'),
    Span('、'),
    A('jQuery').href('https://jquery.com/'),
    Span('… 等 WEB 語言已有了基礎的熟悉，下面就是我的個人 Demo 影片，簡單的展示出這項作品的各項功能，尤其處理照片、瀏覽照片… 等功能，歡迎點閱觀賞。')
  ),
  Div(
    Iframe('https://www.youtube.com/embed/uEcjUy66BCg')
  ).class('iframe'),

  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('Youtube 影片').href('https://www.youtube.com/embed/uEcjUy66BCg')),
    )
  )
]

Load.init({
  data: { key: 'dev', blocks },
  template: El.render(`
    layout => :page=this
      block => *for=(paragraph, i) in blocks   :key=i   :bind=paragraph
  `)
})
