/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2012-02-21')

let blocks = [
  Header(
    H1('用 PHP 實作雲端空間與部落格'),
  ),
  P(
    Span('此作品是大四作品之一，因為製作了'),
    A('相簿系統').href('https://www.ioa.tw/Develop/PHP-Album.html'),
    Span('完後有了更多對於網站開發的心得，於是就馬上開啟了新專案，逐步的開發這個平台，這個作品主要是加強了相簿系統，加入了 上傳檔案、部落格文章、隱私權限、好友管理... 等社群功能。')
  ),
  P(
    Span('作品此次融入了更多的元素，其中包含當時的 Facebook 版型、無名部落格結構、標籤化結構、網路空間、會員系統..等多項功能！因為上一版的相簿視覺上稍顯陽春，所以這次在 '),
    A('CSS').href('https://developer.mozilla.org/zh-TW/docs/Web/CSS'),
    Span(' 下了苦工，刻意的模仿 '),
    A('Facebook').href('https://www.facebook.com/'),
    Span(' 的排版方式，並且結合多項 '),
    A('jQuery').href('https://jquery.com/'),
    Span(' 的效果。')
  ),
  P(
    Span('部落格、相簿、空間的權限限制方式，則參考了無名小站的模式，內容包含了 密碼、好友、指定、隱私...等功能，並且皆可以做標簽管理。文章編輯器使用 '),
    A('CKEditor').href('http://ckeditor.com/'),
    Span('，而相簿與空間皆可以使用 多檔案上傳 的方式上傳，管理檔案方式更是參考了 '),
    A('phpMyAdmin').href('https://www.phpmyadmin.net/'),
    Span(' 的界面，讓個人的後台機制更加的完善！')
  ),
  P('以下是的 Demo 影片，裡面會有詳細的作品介紹，歡迎點閱觀賞。'),
  Div(Iframe('https://www.youtube.com/embed/fuShyDjzrdw')).class('iframe'),
  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('Youtube 影片').href('https://www.youtube.com/embed/fuShyDjzrdw')),
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
