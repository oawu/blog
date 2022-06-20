/**
 * @author      OA Wu <oawu.tw@gmail.com>
 * @copyright   Copyright (c) 2015 - 2022, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

const EL = function(el, ...texts) {
  if (!(this instanceof EL)) return new EL(el, ...texts)
  this.el = el
  if (texts.length == 0) {
    this.text = ''
    this.tokens = null
  } else if (typeof texts[0] == 'string') {
    this.text = texts[0]
    this.tokens = null
  } else {
    this.text = ''
    this.tokens = texts
  }

  this._attr = {}
}
EL.prototype.attr = function(val) { return this._attr = val, this }
EL.prototype.class = function(val) { return this.attr({ ...this._attr, class: val }), this }

const Span = function(...tokens) { if (!(this instanceof Span)) return new Span(...tokens); else EL.call(this, 'span', ...tokens) }
Span.prototype = Object.create(EL.prototype)

const H1 = function(...tokens) { if (!(this instanceof H1)) return new H1(...tokens); else EL.call(this, 'h1', ...tokens) }
H1.prototype = Object.create(EL.prototype)

const H2 = function(...tokens) { if (!(this instanceof H2)) return new H2(...tokens); else EL.call(this, 'h2', ...tokens) }
H2.prototype = Object.create(EL.prototype)

const H3 = function(...tokens) { if (!(this instanceof H3)) return new H3(...tokens); else EL.call(this, 'h3', ...tokens) }
H3.prototype = Object.create(EL.prototype)

const B = function(...tokens) { if (!(this instanceof B)) return new B(...tokens); else EL.call(this, 'b', ...tokens) }
B.prototype = Object.create(EL.prototype)

const Code = function(...tokens) { if (!(this instanceof Code)) return new Code(...tokens); else EL.call(this, 'code', ...tokens) }
Code.prototype = Object.create(EL.prototype)

const Br = function(...tokens) { if (!(this instanceof Br)) return new Br(...tokens); else EL.call(this, 'br', ...tokens) }
Br.prototype = Object.create(EL.prototype)

const Ol = function(...tokens) { if (!(this instanceof Ol)) return new Ol(...tokens); else EL.call(this, 'ol', ...tokens) }
Ol.prototype = Object.create(EL.prototype)

const Ul = function(...tokens) { if (!(this instanceof Ul)) return new Ul(...tokens); else EL.call(this, 'ul', ...tokens) }
Ul.prototype = Object.create(EL.prototype)

const Li = function(...tokens) { if (!(this instanceof Li)) return new Li(...tokens); else EL.call(this, 'li', ...tokens) }
Li.prototype = Object.create(EL.prototype)

const Header = function(...tokens) { if (!(this instanceof Header)) return new Header(...tokens); else EL.call(this, 'header', ...tokens) }
Header.prototype = Object.create(EL.prototype)

const BlockQuote = function(...tokens) { if (!(this instanceof BlockQuote)) return new BlockQuote(...tokens); else EL.call(this, 'blockquote', ...tokens) }
BlockQuote.prototype = Object.create(EL.prototype)
BlockQuote.prototype.info = function(type) { return this.attr({ ...this._attr, class: 'info icon-24' }) }
BlockQuote.prototype.warning = function(type) { return this.attr({ ...this._attr, class: 'warning icon-25' }) }

const Time = function(...tokens) { if (!(this instanceof Time)) return new Time(...tokens); else EL.call(this, 'time', ...tokens) }
Time.prototype = Object.create(EL.prototype)
Time.prototype.datetime = function(datetime) { return this.attr({ ...this._attr, datetime }) }

const P = function(...tokens) { if (!(this instanceof P)) return new P(...tokens); else EL.call(this, 'p', ...tokens) }
P.prototype = Object.create(EL.prototype)

const Div = function(...tokens) { if (!(this instanceof Div)) return new Div(...tokens); else EL.call(this, 'div', ...tokens) }
Div.prototype = Object.create(EL.prototype)

const Footer = function(...tokens) { if (!(this instanceof Footer)) return new Footer(...tokens); else EL.call(this, 'footer', ...tokens) }
Footer.prototype = Object.create(EL.prototype)

const Figure = function(src) { if (!(this instanceof Figure)) return new Figure(src); else EL.call(this, 'figure', Img(src)) }
Figure.prototype = Object.create(EL.prototype)

const A = function(...tokens) { if (!(this instanceof A)) return new A(...tokens); else EL.call(this, 'a', ...tokens), this.attr({ ...this._attr, target: '_blank' }) }
A.prototype = Object.create(EL.prototype)
A.prototype.href = function(href) { return this.attr({ ...this._attr, href }) }

const Img = function(src) { if (!(this instanceof Img)) return new Img(src); else EL.call(this, 'img'), this.attr({ ...this._attr, src }) }
Img.prototype = Object.create(EL.prototype)

const Iframe = function(src) { if (!(this instanceof Iframe)) return new Iframe(src); else EL.call(this, 'iframe'), this.attr({ ...this._attr, src, allowfullscreen: '', frameborder: 0 }) }
Iframe.prototype = Object.create(EL.prototype)

Vue.component('block', {
  props: { bind: { type: P, required: true } },
  template: El.render(`
    component => *if=bind.tokens !== null   v-bind=bind._attr   :is=bind.el
      block => *for=(token, i) in bind.tokens   :key=i   :bind=token
    component => *else   *text=bind.text   v-bind=bind._attr   :is=bind.el
`) })

