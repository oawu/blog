/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2014-12-01')

let blocks = [
  Header(
    H1('實作 jQuery scrollSliderView 套件'),
  ),
  P(
    Span('OA-scrollSliderView 這是一個前端 '),
    A('jQuery').href('https://jquery.com/'),
    Span(' Extend Function，主要架構於 jQuery，此版本是支援 '),
    A('Responsive Web Design(RWD)').href('http://www.ibest.tw/page01.php'),
    Span(' 的頁面。')
  ),
  Figure('https://www.ioa.tw/img/bda5b9f5913a03e2f648d5d0b729f202.jpg'),
  
  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('Live Demo').href('https://works.ioa.tw/OA-scrollSliderView/index.html')),
      Li(A('GitHub 原始碼').href('https://github.com/comdan66/OA-scrollSliderView')),
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
