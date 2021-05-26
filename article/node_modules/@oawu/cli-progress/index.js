/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, @oawu/cli-progress
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

const Xterm = require('@oawu/xterm')

const Progress = {
  lines: [],

  timer: null,
  finish: null,

  option: {
    space: 3, color: false,
    $: {
      title: { value: '', color: text => text },
      subtitle: { value: '', color: text => text },
      percent: { value: '', color: text => text },
      header: { value: '◉', color: text => Xterm.purple(text) },
      newline: { value: '↳', color: text => Xterm.purple(text).dim() },
      dash: { value: '─', color: text => Xterm.dim(text) },
      dot: { value: '…', color: text => Xterm.lightBlack(text).dim() },
      loading: { _value: '⠦⠧⠇⠏⠉⠙⠹⠸⠼⠴⠤⠦', _index: 0, _length: 12, get value () { return this._value[this._index++ % this._length] }, set value (val) { return this._index = 0, this._length = val.length, this._value = val }, color: text => Xterm.yellow(text) },
      done: { value: '完成', color: text => Xterm.green(text) },
      fail: { value: '錯誤', color: text => Xterm.red(text) },
      index: { value: '', color: text => Xterm.dim(text) }
    },
  },

  percent: {
    index: null, total: null, text: '',
    toString (percent) {
      if (this.index !== null && this.total !== null) return percent = Math.ceil(this.index * 100) / this.total, Progress.option.index = '(' + this.index + '/' + this.total + ')', [Progress.option.index, (Progress.option.percent = parseInt(percent <= 100 ? percent >= 0 ? percent : 0 : 100, 10) + '%', Progress.option.percent), this.text].filter(t => t !== '').join(' ' + Progress.option.dash + ' ')
      return this.text !== '' ? ' ' + Progress.option.dash + ' ' + this.text.toString() : ''
    },
    appendTo(lines) {
      if (lines.length) return [...lines].map(({ index, space, str }) => ['\x1b[K', ' '.repeat(Progress.option.space), index ? space + '  ' + Progress.option.newline : Progress.option.header, ' ', index ? (Progress.option.subtitle = str, Progress.option.subtitle) : (Progress.option.title = str, Progress.option.title), index ? '' : this].join('')).join("\n")
      else return ' '.repeat(Progress.option.space) + this
    }
  },

  set advance (val) { return Progress.percent.index += val, Progress.percent.index > Progress.percent.total && (Progress.percent.index = Progress.percent.total), Progress },
  get advance () { return Progress.advance = 1, Progress },
  get clean () { return Progress.option.$.loading._index ? Progress.lines.length > 1 ? '\x1b[' + (Progress.lines.length - 1) + 'A' : "\r" : '' },

  print: (...strs) => process.stdout.write("\r" + strs.join('')),
  
  title (...strs) {
    if (Progress.timer) return Progress
    else return Progress.option.$.loading._index = 0, Progress.lines = strs.map((line, index) => { const match = /(?<space>^\s*)(?<str>.*)/gm.exec(line); return match !== null ? { ...match.groups, index } : match }).filter(line => line !== null), Progress.timer = setInterval(_ => Progress.finish ? Progress.stop() : Progress.print(Progress.clean + Progress.percent.appendTo(Progress.lines) + Progress.option.dot + ' ' + Progress.option.loading + ' '), 85), Progress
  },
  total (total) {
    return Progress.percent.total = total, Progress.percent.index = 0, Progress
  },
  stop () {
    if (Progress.timer === null) return Progress
    else return Progress.print(Progress.clean + Progress.percent.appendTo(Progress.lines) + "\n"), clearInterval(Progress.timer), Progress.lines = [], Progress.percent.index = null, Progress.percent.total = null, Progress.percent.text = '', Progress.option.$.loading._index = 0, Progress.finish(), Progress.finish = null, Progress.timer = null, Progress
  },
  done (message = '完成') {
    return Progress.percent.index = Progress.percent.total, Progress.option.done = message, Progress.percent.text = Progress.option.done, Progress.stop(Progress.finish = _ => {}), Progress
  },
  fail (message = '錯誤', ...errors) {
    return Progress.option.fail = message === null || message === undefined ? '錯誤' : message, Progress.percent.text = Progress.option.fail, Progress.stop(Progress.finish = _ => Progress.error(...errors)), Progress
  },
  error (...errors) {
    return errors.length && Progress.print((Progress.option.color ? "\n 【錯誤訊息】\n".red : "\n 【錯誤訊息】\n") + errors.map(error => ' '.repeat(Progress.option.space) + Progress.option.header + ' ' + (error instanceof Error ? error.stack : error) + "\n").join('') + "\n") && process.emit('SIGINT'), Progress
  },
}

Object.keys(Progress.option.$).forEach(key => Object.defineProperty(Progress.option, key, {
    set: val => Progress.option.$[key].value = val,
    get: _ => {
      const f = function() {}
      return f.toString = _ => Progress.option.color ? Progress.option.$[key].color(Progress.option.$[key].value).toString() : Progress.option.$[key].value, Object.defineProperty(f, 'color', { set: func => Progress.option.$[key].color = func }), f
    }
  }))

module.exports = Progress
