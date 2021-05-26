/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2009-04-07')

let blocks = [
  Header(
    H1('用 Java 實作 Plurker'),
  ),

  P(
    Span('當年大學三年級時期藉由'),
    A('噗浪').href('https://www.plurk.com/'),
    Span('官方提供的 '),
    A('API').href('http://www.plurk.com/API'),
    Span('、'),
    A('SDK').href('https://zh.wikipedia.org/wiki/%E8%BD%AF%E4%BB%B6%E5%BC%80%E5%8F%91%E5%B7%A5%E5%85%B7%E5%8C%85'),
    Span(' 實作了一個以 '),
    A('Java GUI').href('https://zh.wikipedia.org/wiki/Swing_(Java)'),
    Span(' 呈現的作品，主要功能是結合噗浪微網誌的社群管理軟體。其中更包含了'),
    B('軟體安裝'),
    Span('、'),
    B('多角色登入'),
    Span('、'),
    B('發訊息'),
    Span('、'),
    B('回復訊息'),
    Span('、'),
    B('智慧回復機器人'),
    Span('.. 等。')
  ),
  P(
    Span('會取名 '),
    B('Plurker'),
    Span(' 主要是因為噗浪英文名稱 “Plurk”，所以加個 “er”，'),
    A('GitHub').href('https://github.com/comdan66/junior-java-plurker'),
    Span(' 上有提供當年的程式碼，有興趣的各位歡迎點閱，不過年代久遠，所以程式碼架構與寫法並不是很美觀，所以建議先觀看以下是的 Demo 影片，影片裡面會有詳細的功能介紹！')
  ),
  Div(
    Iframe('https://www.youtube.com/embed/12P3aX6LQac')
  ).class('iframe'),

  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('GitHub 原始碼').href('https://github.com/comdan66/junior-java-plurker')),
      Li(A('Youtube 影片').href('https://www.youtube.com/watch?v=12P3aX6LQac')),
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
