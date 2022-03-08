/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, LaliloCore
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

const Build = function() {
  if (!(this instanceof Build)) return new Build()
}
Build.prototype.build = function() {}

const Menu = function(...items) {
  if (!(this instanceof Menu)) return new Menu(...items)
  this._items = items.filter(item => item instanceof Build)
}
Menu.prototype = Object.create(Build.prototype)
Menu.prototype.build = function() { return this._items.forEach(item => item.build()), this }


const Articles = function(key) {
  if (!(this instanceof Articles)) return new Articles(key)

}
Articles.prototype = Object.create(Build.prototype)

const Article = function(key, parent = null) {
  if (!(this instanceof Article)) return new Article(key, parent)
}

Article.prototype = Object.create(Build.prototype)

const menu = Menu(
  Article('index'),
  Articles('dev'),
  Articles('mac'),
  Articles('aws'),
  Articles('rpi'),
  Articles('note'),
  Articles('mazu'),
  Articles('unbox'),
  Article('license')
)

menu.build()



















// module.exports = Article