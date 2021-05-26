/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2014-11-28')

let blocks = [
  Header(
    H1('實作 jQuery imgLiquid 套件'),
  ),
  P(
    Span('imgLiquid 是一個處理前端圖片置中的 '),
    A('jQuery').href('https://jquery.com/'),
    Span(' Extend Function，其中參考了 '),
    A('imgLiquid').href('https://github.com/karacas/imgLiquid'),
    Span('，但其架構與做法不大相同。')
  ),
  Figure('https://www.ioa.tw/img/3261671f5b428f8f93d1c82f64eea610.jpg').attr({ alt: '垂直置中(藍色為父層、黃色為,img,元素)' }),
  Figure('https://www.ioa.tw/img/2c9e72593d9a32f0decb8e4fc74b5ac3.jpg').attr({ alt: '水平置中(藍色為父層、黃色為,img,元素)' }),
  P('此作品雖然與 imgLiquid 功能一樣，但是做法不同，前者將  設定成隱藏，在取出其圖片網址後設定在該  父元素的 Style，而我的這次要實作的雖然目的相同，但做法則不一樣。'),
  P('首先需要幾個先決條件：'),
  Ul(
    Li('父層 position 一定要是 position、absolute、fixed。'),
    Li('父層一定要有設定 width 以及 height。')
  ),
  P('做法是將指定的元素 position 設定成 absolute，在用 top、right、bottom、left 去調整位置，而此時父層再加上一項屬性 overflow: hidden; 即可做到調整位置的效果了！'),
  P(
    Span('其中功能也加入很多方式使用，包含了搭配'),
    A('元素屬性').href('http://w3school.com.cn/html/html_attributes.asp'),
    Span('設定..等功能，若要更清楚瞭解可以置 '),
    A('GitHub').href('https://github.com/comdan66/OA-imgLiquid#%E7%9B%AE%E9%8C%84'),
    Span(' 查看說明。')
  ),

  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('Live Demo').href('https://works.ioa.tw/OA-imgLiquid/index.html')),
      Li(A('GitHub 原始碼').href('https://github.com/comdan66/OA-imgLiquid')),
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
