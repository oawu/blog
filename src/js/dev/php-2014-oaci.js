/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2014-11-11')

let blocks = [
  Header(
    H1('2014 OACI'),
  ),
  P(
    Span('這是一個以 '),
    A('CodeIgniter 2.1.4').href('https://ellislab.com/codeigniter/user-guide/installation/downloads.html'),
    Span(' 為基礎版本，將其新增進階功能的一套好用的 '),
    A('PHP').href('https://zh.wikipedia.org/wiki/PHP'),
    Span(' Framework，加入了 '),
    A('PHP ActiveRecord').href('http://www.phpactiverecord.org/'),
    Span(' 並且與 OrmUploader 讓圖片網址處理更方便，以及多樣的前後端整併。')
  ),
  P(
    Span('這一套個人的 Framework 如入了多樣的資源參考，其中參考了 '),
    A('Ruby on Rails').href('http://rubyonrails.org/'),
    Span(' 的 '),
    A('RubyGems').href('https://rubygems.org/'),
    Span(' 相關工具，以及導入 '),
    A("OA's ElasticSearch").href('https://www.ioa.tw/Develop/PHP-ElasticSearch-PDO.html'),
    Span(' 工具，並且與前端工具 '),
    A('Compass').href('http://compass-style.org/'),
    Span('、'),
    A('Gulp').href('http://gulpjs.com/'),
    Span(' 做結合、加入多樣的常用函式，最重要的加入了 PHP 指令的管理，例如 Create、Delete、Migration.. 等管理指令。')
  ),
  P(
    A('GitHub').href('https://github.com/comdan66/oaci#%E5%B8%B8%E7%94%A8%E6%8C%87%E4%BB%A4'),
    Span(' 上的 Readme 有初步的簡介這套 Framework 幾項主要功能，並且實作範例，讓使用者能順利了解。')
  ),
  P(
    Span('以下是 '),
    A('Youtube').href('https://www.youtube.com/'),
    Span(' 簡單 Demo 初始化使用基本 CRUD 的流程：')
  ),
  Div(Iframe('https://www.youtube.com/embed/svomGfqxZvg')).class('iframe'),
  H3('以下是目前幾項主要功能：'),
  Ul(
    Li('匯入並且使用 PHP ActiveRecord ORM，並且可以與 OrmUploader 搭配結合。'),
    Li(
      Span('匯入使用 OrmUploader 的 Library，此功能設計主要參考 Ruby on Rails 上 RubyGems 的 '),
      A('carrierwave').href('https://github.com/carrierwaveuploader/carrierwave'),
      Span(' 套件，可搭配 ORM 使用 ImageUplader、FileUploader 處理上傳表單，其中 ImageUplader 更可配合使用 ImageGdUtility、ImageImagickUtility 針對圖片做壓縮處理。')
    ),
    Li(
      Span('匯入使用 '),
      A('Redis').href('http://redis.io/'),
      Span(' Cache Library。')
    ),
    Li(
      Span('匯入使用 cell 的 Library，此功能主要參考 Ruby on Rails 上 RubyGems 的 '),
      A('cells').href('https://github.com/apotonick/cells'),
      Span(' 所設計，並且加強有層級結構關係、暫存快取機制、導入可使用 Redis Cache。')
    ),
    Li('加強 CodeIgniter 原生 Config 機制，讓原本取得 Config 做成快取並且將 File Cache 的 Folder 的重新定義向下延伸分類資料夾。'),
    Li('匯入可記錄 Delay Request 的 Log 以及 ORM Query Log。'),
    Li('匯入並且可使用 Compass、Scss、Gulp。'),
    Li(
      Span('匯入 '),
      A('OA-ElasticSearch').href('https://www.ioa.tw/Develop/PHP-ElasticSearch-PDO.html'),
      Span(' 加入 '),
      A('ElasticSearch').href('https://www.elastic.co/'),
      Span(' 的使用以及相關管理指令。')
    )
  ),

  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('Youtube 影片').href('https://www.youtube.com/watch?&v=svomGfqxZvg')),
      Li(A('GitHub 原始碼').href('https://github.com/comdan66/oaci')),
      Li(A('PHP ActiveRecord').href('http://www.phpactiverecord.org/')),
      Li(A('PHP ActiveRecord GitHub').href('https://github.com/jpfuentes2/php-activerecord')),
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
