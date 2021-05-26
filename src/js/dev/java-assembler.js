/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2009-05-01')

let blocks = [
  Header(
    H1('用 Java 實作 Assembler'),
  ),
  P(
    Span('這是大學二年級時在系統程式課程中所實作的 '),
    A('Assembler 組譯器').href('https://en.wikipedia.org/wiki/Assembly_language#Assembler'),
    Span('，主功能是將 '),
    A('SIC XE Literal').href('https://en.wikipedia.org/wiki/SIC/XE'),
    Span(' 的'),
    A('組合語言').href('https://zh.wikipedia.org/wiki/%E6%B1%87%E7%BC%96%E8%AF%AD%E8%A8%80'),
    Span('編譯成'),
    A('機械語言').href('https://zh.wikipedia.org/wiki%E6%9C%BA%E5%99%A8%E8%AF%AD%E8%A8%80'),
    Span('，借由實作這個轉換器的同時，可以更加的了解組合語言與機械語言間的關係與原理。當時會選擇使用 '),
    A('Java').href('https://zh.wikipedia.org/wiki/Java'),
    Span(' 是因為 '),
    A('GUI').href('https://zh.wikipedia.org/wiki/Swing_(Java)'),
    Span(' 介面更容易表現出理想的操作介面，更可以讓使用者更加方便轉換組合語言。')
  ),
  P(
    Figure('https://www.ioa.tw/img/fd3b42f24e5b8e9a406f9a270f872137.jpg')
  ),
  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  Footer(
    H2('相關參考'),
    Ul(
      Li(A('GitHub 原始碼').href('https://github.com/comdan66/sophomore-java-assembler')),
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
