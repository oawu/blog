/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, @oawu/xterm
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

const Xterm = function(text) {
  if (!(this instanceof Xterm)) {
    return new Xterm(text)
  }
  this.text = text
  this.codes = []
}

Xterm.prototype = { ...Xterm.prototype,
  toString () { return this.codes.reduce((a, b) => b + a + '\x1b[0m', this.text) },
  blod () { return this.code('\x1b[1m') },
  dim () { return this.code('\x1b[2m') },
  italic () { return this.code('\x1b[3m') },
  underline () { return this.code('\x1b[4m') },
  blink () { return this.code('\x1b[5m') },
  inverted () { return this.code('\x1b[7m') },
  hidden () { return this.code('\x1b[8m') },
  code (code) { return this.codes.push(code), this },
  color (code) { return this.code('\x1b[38;5;' + code + 'm') },
  background (code) { return this.code('\x1b[48;5;' + code + 'm') },
  bg (code) { return this.background(code) },
}

Xterm.blod      = text => Xterm(text).blod()
Xterm.dim       = text => Xterm(text).dim()
Xterm.italic    = text => Xterm(text).italic()
Xterm.underline = text => Xterm(text).underline()
Xterm.blink     = text => Xterm(text).blink()
Xterm.inverted  = text => Xterm(text).inverted()
Xterm.hidden    = text => Xterm(text).hidden()

Xterm.black  = text => Xterm(text).color(0)
Xterm.red    = text => Xterm(text).color(1)
Xterm.green  = text => Xterm(text).color(2)
Xterm.yellow = text => Xterm(text).color(3)
Xterm.blue   = text => Xterm(text).color(4)
Xterm.purple = text => Xterm(text).color(5)
Xterm.cyan   = text => Xterm(text).color(6)
Xterm.gray   = text => Xterm(text).color(7)

Xterm.lightBlack  = text => Xterm(text).color(8)
Xterm.lightRed    = text => Xterm(text).color(9)
Xterm.lightGreen  = text => Xterm(text).color(10)
Xterm.lightYellow = text => Xterm(text).color(11)
Xterm.lightBlue   = text => Xterm(text).color(12)
Xterm.lightPurple = text => Xterm(text).color(13)
Xterm.lightCyan   = text => Xterm(text).color(14)
Xterm.lightGray   = text => Xterm(text).color(15)

Xterm.bgBlack  = Xterm.backgroundBlack  = text => Xterm(text).bg(0)
Xterm.bgRed    = Xterm.backgroundRed    = text => Xterm(text).bg(1)
Xterm.bgGreen  = Xterm.backgroundGreen  = text => Xterm(text).bg(2)
Xterm.bgYellow = Xterm.backgroundYellow = text => Xterm(text).bg(3)
Xterm.bgBlue   = Xterm.backgroundBlue   = text => Xterm(text).bg(4)
Xterm.bgPurple = Xterm.backgroundPurple = text => Xterm(text).bg(5)
Xterm.bgCyan   = Xterm.backgroundCyan   = text => Xterm(text).bg(6)
Xterm.bgGray   = Xterm.backgroundGray   = text => Xterm(text).bg(7)

Xterm.bgLightBlack  = Xterm.backgroundLightBlack  = text => Xterm(text).bg(8)
Xterm.bgLightRed    = Xterm.backgroundLightRed    = text => Xterm(text).bg(9)
Xterm.bgLightGreen  = Xterm.backgroundLightGreen  = text => Xterm(text).bg(10)
Xterm.bgLightYellow = Xterm.backgroundLightYellow = text => Xterm(text).bg(11)
Xterm.bgLightBlue   = Xterm.backgroundLightBlue   = text => Xterm(text).bg(12)
Xterm.bgLightPurple = Xterm.backgroundLightPurple = text => Xterm(text).bg(13)
Xterm.bgLightCyan   = Xterm.backgroundLightCyan   = text => Xterm(text).bg(14)
Xterm.bgLightGray   = Xterm.backgroundLightGray   = text => Xterm(text).bg(15)

Xterm.stringPrototype = function() {
  if (String.prototype.xterm) return
  else String.prototype.xterm = true

  Object.defineProperty(String.prototype, 'blod', { get () { return Xterm.blod(this).toString() } })
  Object.defineProperty(String.prototype, 'dim', { get () { return Xterm.dim(this).toString() } })
  Object.defineProperty(String.prototype, 'italic', { get () { return Xterm.italic(this).toString() } })
  Object.defineProperty(String.prototype, 'underline', { get () { return Xterm.underline(this).toString() } })
  Object.defineProperty(String.prototype, 'blink', { get () { return Xterm.blink(this).toString() } })
  Object.defineProperty(String.prototype, 'inverted', { get () { return Xterm.inverted(this).toString() } })
  Object.defineProperty(String.prototype, 'hidden', { get () { return Xterm.hidden(this).toString() } })

  Object.defineProperty(String.prototype, 'black', { get () { return Xterm.black(this).toString() } })
  Object.defineProperty(String.prototype, 'red', { get () { return Xterm.red(this).toString() } })
  Object.defineProperty(String.prototype, 'green', { get () { return Xterm.green(this).toString() } })
  Object.defineProperty(String.prototype, 'yellow', { get () { return Xterm.yellow(this).toString() } })
  Object.defineProperty(String.prototype, 'blue', { get () { return Xterm.blue(this).toString() } })
  Object.defineProperty(String.prototype, 'purple', { get () { return Xterm.purple(this).toString() } })
  Object.defineProperty(String.prototype, 'cyan', { get () { return Xterm.cyan(this).toString() } })
  Object.defineProperty(String.prototype, 'gray', { get () { return Xterm.gray(this).toString() } })

  Object.defineProperty(String.prototype, 'lightBlack', { get () { return Xterm.lightBlack(this).toString() } })
  Object.defineProperty(String.prototype, 'lightRed', { get () { return Xterm.lightRed(this).toString() } })
  Object.defineProperty(String.prototype, 'lightGreen', { get () { return Xterm.lightGreen(this).toString() } })
  Object.defineProperty(String.prototype, 'lightYellow', { get () { return Xterm.lightYellow(this).toString() } })
  Object.defineProperty(String.prototype, 'lightBlue', { get () { return Xterm.lightBlue(this).toString() } })
  Object.defineProperty(String.prototype, 'lightPurple', { get () { return Xterm.lightPurple(this).toString() } })
  Object.defineProperty(String.prototype, 'lightCyan', { get () { return Xterm.lightCyan(this).toString() } })
  Object.defineProperty(String.prototype, 'lightGray', { get () { return Xterm.lightGray(this).toString() } })

  Object.defineProperty(String.prototype, 'bgBlack', { get () { return Xterm.bgBlack(this).toString() } })
  Object.defineProperty(String.prototype, 'bgRed', { get () { return Xterm.bgRed(this).toString() } })
  Object.defineProperty(String.prototype, 'bgGreen', { get () { return Xterm.bgGreen(this).toString() } })
  Object.defineProperty(String.prototype, 'bgYellow', { get () { return Xterm.bgYellow(this).toString() } })
  Object.defineProperty(String.prototype, 'bgBlue', { get () { return Xterm.bgBlue(this).toString() } })
  Object.defineProperty(String.prototype, 'bgPurple', { get () { return Xterm.bgPurple(this).toString() } })
  Object.defineProperty(String.prototype, 'bgCyan', { get () { return Xterm.bgCyan(this).toString() } })
  Object.defineProperty(String.prototype, 'bgGray', { get () { return Xterm.bgGray(this).toString() } })

  Object.defineProperty(String.prototype, 'bgLightBlack', { get () { return Xterm.bgLightBlack(this).toString() } })
  Object.defineProperty(String.prototype, 'bgLightRed', { get () { return Xterm.bgLightRed(this).toString() } })
  Object.defineProperty(String.prototype, 'bgLightGreen', { get () { return Xterm.bgLightGreen(this).toString() } })
  Object.defineProperty(String.prototype, 'bgLightYellow', { get () { return Xterm.bgLightYellow(this).toString() } })
  Object.defineProperty(String.prototype, 'bgLightBlue', { get () { return Xterm.bgLightBlue(this).toString() } })
  Object.defineProperty(String.prototype, 'bgLightPurple', { get () { return Xterm.bgLightPurple(this).toString() } })
  Object.defineProperty(String.prototype, 'bgLightCyan', { get () { return Xterm.bgLightCyan(this).toString() } })
  Object.defineProperty(String.prototype, 'bgLightGray', { get () { return Xterm.bgLightGray(this).toString() } })

  return Xterm
}

module.exports = Xterm
