/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2008-05-01')

let blocks = [
  Header(
    H1('用 Java 實作小畫家'),
  ),
  P(
    Span('這是大學一年級的下學期高等程式設計的學期作業，因為實作讓我對物件導向語言的'),
    B('封裝'),
    Span('、'),
    B('繼承'),
    Span('、'),
    B('多型'),
    Span('..等特性更加熟悉！有別於上學期的 C，Java 可以利用 '),
    A('GUI 介面').href('https://zh.wikipedia.org/wiki/Swing_(Java)'),
    Span('實作出我理想中的作品，並且可以以封裝成 .jar 的方式與朋友分享。')
  ),
  P(
    Figure('https://www.ioa.tw/img/11b570ee420c1486860a4c997797931f.jpg')
  ),

  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('GitHub 原始碼').href('https://github.com/comdan66/freshman-java-painter')),
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
