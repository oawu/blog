/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('2010-04-17')

let blocks = [
  Header(
    H1('Arduino 新銳展翅創意競賽'),
  ),

  Time(timeAt.dateText).datetime(timeAt.toString()),
  
  P(
    Span('大三專題中使用了 '),
    A('Arduino UNO').href('https://www.arduino.cc/en/Main/ArduinoBoardUno'),
    Span(' 以及多項 Sensor 組合出多項功能作品，主要架構是以 Arduino 與各個裝置互相溝通，溝通的方式使用 '),
    A('XBee').href('https://en.wikipedia.org/wiki/XBee'),
    Span(' 無線套件。作品功能大致上是借由不同 Arduino 所收集到的資訊並彙集並且提供給駕駛者車況等安全資訊，所以算是基本版的 '),
    B('智慧型腳踏車'),
    Span(' 實作。')
  ),

  Figure('https://www.ioa.tw/img/21eac4fe67be59b5d34cc1ce41291590.jpg').attr({ alt: '搭載各種感應器，簡單以紙箱示意腳踏車，實作智慧型腳踏車的概念模型' }),
  Figure('https://www.ioa.tw/img/0dc8f90eba19684535a5e660a52494a5.jpg').attr({ alt: '2010年,新銳展翅創意競賽會場' }),
  Figure('https://www.ioa.tw/img/dbd59b9c5e05041b2c560cd2f0707a5d.jpg').attr({ alt: '2010年,新銳展翅創意競賽,參賽證' }),
  Figure('https://www.ioa.tw/img/016ab80a8562e73b14f0d20623b11fa7.jpg').attr({ alt: '2010年,新銳展翅創意競賽,佳作獎狀證明' }),
]

Load.init({
  data: { key: 'dev', blocks },
  template: El.render(`
    layout => :page=this
      block => *for=(paragraph, i) in blocks   :key=i   :bind=paragraph
  `)
})
