/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2012-11-17')

let blocks = [
  Header(
    H1('用 C 語言寫漫畫下載器'),
  ),

  P(
    Span('這是個使用 '),
    A('C 語言').href('https://zh.wikipedia.org/wiki/C%E8%AF%AD%E8%A8%80'),
    Span('的 Console 畫面去繪出模擬 '),
    A('BBS').href('https://zh.wikipedia.org/zh-tw/BBS'),
    Span(' 版型，並且利用 wget 指令將知名網站 '),
    A('8comic').href('http://www.comicbus.com/'),
    Span(' 上的原始碼轉譯出漫畫並下載，簡單說就是使用 C 語言製作一個'),
    A('爬蟲').href('https://zh.wikipedia.org/wiki/%E7%B6%B2%E8%B7%AF%E8%9C%98%E8%9B%9B'),
    Span('，並且以 Console 的方式模擬 BBS 介面的排版，然後將爬回來的數據以 '),
    A('HTML').href('http://www.w3schools.com/html/'),
    Span(' 方式開啟。')
  ),
  Figure('https://www.ioa.tw/img/d8344f56652ed6cc3e94b74ebedc0e0e.jpg').attr({ alt: '此實作是使用,C語言,Console,界面繪出模擬,BBS,版型' }),
  Figure('https://www.ioa.tw/img/a2258bd047835755a9186c03dc1666d9.jpg').attr({ alt: '並且利用,wget,將知名網站,8comic,上的原始碼轉譯出漫畫並下載，簡單說就是使用,C語言,製作一個爬蟲，並且以,Console,的方式模擬,BBS,介面的排版' }),
  P(
    Span('作品靈感來源只是想方便看漫畫，所以動手寫了程式將網站上的圖檔可以依照自己的選擇進行下載，程式中利用了 '),
    A('SQLite').href('https://www.sqlite.org/'),
    Span('、C 語言多重'),
    A('指標').href('https://zh.wikipedia.org/zh-tw/%E6%8C%87%E6%A8%99_(%E9%9B%BB%E8%85%A6%E7%A7%91%E5%AD%B8)'),
    Span('、網頁語言工具..等。下載後的漫畫皆會存在客戶端的資料夾裡面，搭配 '),
    A('JavaScript').href('https://zh.wikipedia.org/zh-tw/JavaScript'),
    Span('、HTML 來達到瀏覽效果，所以只要開啟資料夾內的 index.html 即可方便看漫畫，有興趣也歡迎至 '),
    A('GitHub').href('https://github.com/comdan66/c-comic-book'),
    Span(' 下載執行檔、原始碼試試，不過此作目前已經沒在維護，若 8comic 網站有更新原始碼的話，則'),
    B('不保證'),
    Span('可以正常下載漫畫。')
  ),
  Figure('https://www.ioa.tw/img/efca6b8b52b1cadd17e49b3aeff05602.jpg').attr({ alt: '並且利用,wget,將知名網站,8comic,上的原始碼轉譯出漫畫並下載' }),
  Figure('https://www.ioa.tw/img/357b25954b93e933b03cce11b3ed23b6.jpg').attr({ alt: '聲明、介紹與使用方式' }),
  Figure('https://www.ioa.tw/img/95f4b67124260130daad6f228e749b4d.jpg').attr({ alt: '下載完後會儲存於,Download,目錄下' }),
  P(
    Span('其中 BBS 介面的方式是自行制定一套檔案規則，並且放置在 '),
    A('Interface/').href('https://github.com/comdan66/c-comic-book/tree/master/Interface'),
    Span(' 目錄下，當要產生畫面時，C語言 去讀取自訂的字串規格，並且在 Console 上格式化即可達到想要的畫面。換句話就是自行實作一個簡單的 '),
    A('MVC').href('https://zh.wikipedia.org/zh-tw/MVC'),
    Span(' 架構的 View。')
  ),
  P(
    B('※'),
    Span(' 目前此作品已經沒有再更新與維護囉！')
  ),

  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('GitHub 原始碼').href('https://github.com/comdan66/c-comic-book')),
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
