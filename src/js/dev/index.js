/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

let timeAt = Datetime('')

let blocks = [
  Header(
    H1('開發心得'),
  ),
]

let articles = [
  { title: 'EC2 被鎖住不能使用 SSH 登入 怎麼辦？', subtitle: '', href: '/dev/aws-ec2-lock-ssh' + EXT },

  { title: '奇拓室內裝修設計', subtitle: '', href: '/dev/case-chitorch' + EXT },
  { title: '實作 jQuery scrollSliderView 套件', subtitle: '', href: '/dev/jquery-scroll-slider-view-extend' + EXT },
  { title: '實作 jQuery imgLiquid 套件', subtitle: '', href: '/dev/jquery-img-liquid-extend' + EXT },
  { title: '2014 OACI', subtitle: '', href: '/dev/php-2014-oaci' + EXT },
  { title: '用 C 語言寫漫畫下載器', subtitle: '', href: '/dev/c-language-comic-book' + EXT },
  { title: '用 PHP 實作雲端空間與部落格', subtitle: '', href: '/dev/php-blog' + EXT },
  { title: '用 jQuery 做一套遊戲', subtitle: '', href: '/dev/jquery-pokemon-game' + EXT },
  { title: '用 PHP 實作網路相簿', subtitle: '', href: '/dev/php-album' + EXT },
  { title: 'Arduino 新銳展翅創意競賽', subtitle: '', href: '/dev/arduino-competition' + EXT },
  { title: '用 Java 實作 Assembler', subtitle: '', href: '/dev/java-assembler' + EXT },
  { title: '用 Java 實作 Plurker', subtitle: '', href: '/dev/java-plurker' + EXT },
  { title: '用 Java 實作 MSN', subtitle: '', href: '/dev/java-msn' + EXT },
  { title: '用 Java 實作小畫家', subtitle: '', href: '/dev/java-painter' + EXT },
]

Load.init({
  data: { key: 'dev', blocks, articles },
  template: El.render(`
    layout => :page=this

      block => *for=(paragraph, i) in blocks   :key=i   :bind=paragraph
      
      div#articles
        a => *for=(article, i) in articles   :key=i   :href=article.href
          b => *text=article.title
          span => *if=article.subtitle   *text=article.subtitle
  `)
})
