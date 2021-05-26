/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2014-12-03')

let blocks = [
  Header(
    H1('奇拓室內裝修設計'),
  ),
  P(
    Span('這是一個後端技術的外包案實作，其網站名稱為'),
    A('奇拓室內裝修設計').href('http://www.chitorch.com/'),
    Span('，奇拓室內裝修設計是我近年來第一個與'),
    A('宙思設計').href('https://www.zeusdesign.com.tw/'),
    Span('承接的網站外包案，不過這專案我並非為全端作業，而是只實作後端與系統的部分，前端刻板則由宙思設計所製作。')
  ),
  Figure('https://www.ioa.tw/img/d7ceb9e061d00b645fc1f2cf624a518c.jpg').attr({ alt: '宙思設計,-,奇拓室內裝修設計' }),
  Figure('https://www.ioa.tw/img/22dc0059c9191aaec4961014b0e86afc.jpg').attr({ alt: '列表頁包含了多樣的查詢方式' }),
  Figure('https://www.ioa.tw/img/2565348142f6e1b459a59b8d099bf8a6.jpg').attr({ alt: '響應式網頁設計' }),
  P(
    Span('後端主要功能是提供上稿系統，以提供前台畫面使用，所以主要功能為一般的 '),
    A('Create、Read、Update、Delete(CRUD)').href('https://zh.wikipedia.org/wiki/%E8%B3%87%E6%96%99%E6%93%8D%E7%B8%B1%E8%AA%9E%E8%A8%80'),
    Span(' 操作。網站同時是有提供響'),
    A('應式設計(RWD)').href('http://www.ibest.tw/page01.php'),
    Span('，所以在手機瀏覽上亦能順暢閱讀。後端架構上使用 '),
    A('PHP 5.6').href('http://php.net/ChangeLog-5.php'),
    Span(' 而框架上則是使用 '),
    A('CodeIgniter version 2.1.4').href('https://codeigniter.org.tw/'),
    Span(' 所實作的。')
  ),
  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('Live Demo').href('https://www.chitorch.com/')),
      Li(A('GitHub 原始碼').href('https://github.com/comdan66/chitorch')),
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
