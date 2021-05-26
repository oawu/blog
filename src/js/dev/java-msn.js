/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2008-10-01')

let blocks = [
  Header(
    H1('用 Java 實作 MSN'),
  ),

  P(
    Span('因為學習 '),
    A('Java').href('https://zh.wikipedia.org/wiki/Java'),
    Span(' 語言而發現了有 '),
    A('UDT').href('https://zh.wikipedia.org/wiki/UDT'),
    Span('、'),
    A('TCP').href('https://zh.wikipedia.org/wiki/%E5%82%B3%E8%BC%B8%E6%8E%A7%E5%88%B6%E5%8D%94%E5%AE%9A'),
    Span(' 通訊協定的 '),
    A('Socket').href('https://en.wikipedia.org/wiki/Network_socket'),
    Span(' 物件可以使用，所以就在利用 '),
    A('Java GUI').href('https://zh.wikipedia.org/wiki/Swing_(Java)'),
    Span(' 與 Socket 做了簡單結合，由基本的 Java Socket 實作基本的'),
    A('主從式架構（Client-Server）').href('https://zh.wikipedia.org/wiki/%E4%B8%BB%E5%BE%9E%E5%BC%8F%E6%9E%B6%E6%A7%8B'),
    Span('的伺服端、客戶端，藉由伺服器的角色幫助客服端建立連線而達到通訊的功能，並且模擬 '),
    A('P2P').href('https://zh.wikipedia.org/wiki/%E5%B0%8D%E7%AD%89%E7%B6%B2%E8%B7%AF'),
    Span(' 的連線機制，以自定義簡單的格式來達到基本的溝通串流。')
  ),
  P(
    A('GitHub').href('https://github.com/comdan66/sophomore-java-msn'),
    Span(' 上目前提供 '),
    A('.jar 檔案').href('https://zh.wikipedia.org/wiki/JAR_(%E6%96%87%E4%BB%B6%E6%A0%BC%E5%BC%8F)'),
    Span('，之後會補上原始碼，而以下是的 Demo 影片，裡面會有詳細的功能介紹。')
  ),
  Div(
    Iframe('https://www.youtube.com/embed/Z8ozcKeDsbk')
  ).class('iframe'),

  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('GitHub jar 檔案').href('https://github.com/comdan66/sophomore-java-msn')),
      Li(A('Youtube 影片').href('https://www.youtube.com/watch?v=Z8ozcKeDsbk')),
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
