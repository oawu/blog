/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2010-07-01')

let blocks = [
  Header(
    H1('用 jQuery 做一套遊戲'),
  ),
  P('大學期間學習網頁開發過程中，總是會有一些有趣的靈感，而我總是喜歡使用我所會的語言工具，去將想法實現出來，而使用 jQuery 製作遊戲也是我的一項小小里程碑。'),
  P(
    Span('這作品相信大家會有似曾相似感，靈感來自於 '),
    A('Nintendo').href('http://www.nintendo.tw/'),
    Span(' 的一款遊戲，叫做 '),
    A('Pokémon').href('https://en.wikipedia.org/wiki/Pok%C3%A9mon'),
    Span('，當初構想曾有過大至商城化、地圖化劇情，但由於多項因素就沒將它完整的完成。其中個人最滿意的部分是全部網站效果皆由 jQuery 製作，而圖示、視覺，則利用'),
    A('小畫家').href('http://windows.microsoft.com/zh-tw/windows-vista/open-paint'),
    Span('、'),
    A('PhotoImpact').href('https://zh.wikipedia.org/wiki/Ulead_PhotoImpact'),
    Span(' 獨立完成。')
  ),
  P('以下是 Demo 影片，演釋了整個遊戲的流程，歡迎有興趣者點閱。'),
  Div(Iframe('https://www.youtube.com/embed/9cPiXCAnA6E')).class('iframe'),
  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('Youtube 影片').href('https://www.youtube.com/embed/9cPiXCAnA6E')),
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
