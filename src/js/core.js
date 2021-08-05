/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */


// Local Storage
const Data = {
  enable: typeof Storage !== 'undefined' && typeof localStorage !== 'undefined' && typeof JSON !== 'undefined',
  set (key, val) { return this.enable && localStorage.setItem(key, JSON.stringify({ val: val })), this },
  get (key) { return this.enable && (key = localStorage.getItem(key)) ? JSON.parse(key).val : null }
}

// Element
const El = {
  splitLength: 3,
  split: (line, regex) => {
    let match = line.match(regex)
    if (match) return regex = line.indexOf(match[0]), match = match.shift(), { header: line.substring(0, regex).trim(), tokens: line.substring(regex + match.length).trim(), match }
    else return { header: line.trim(), tokens: '', match: '' }
  },
  toVue: (key, val) => key && val ? { key: key.replace(/^\*/, 'v-').replace(/^@/, 'v-on:'), val: val.replace(/"/g, "'") } : null,
  render (str) {
    const lines = str.split("\n").filter(t => t.trim().length).map(line => {
      const space = line.search(/\S|$/)
      const splitLine = this.split(line, /\s+=\>\s+/gm)
      const tmpHeader = this.split(splitLine.header, /\.|#/gm)
      const tokens = (splitLine.tokens + (tmpHeader.match + tmpHeader.tokens).replace(/#/gm, ' '.repeat(this.splitLength) + '#').replace(/\./gm, ' '.repeat(this.splitLength) + '.')).split(new RegExp('\\s{' + this.splitLength + ',}', 'gm')).map(attr => {
        if (attr === '*else')
          return { key: 'v-else', val: null }

        attr[0] === '#' && !attr.includes('=') && (attr = 'id=' + attr.substr(1))
        attr[0] === '.' && !attr.includes('=') && (attr = 'class=' + attr.substr(1).replace('.', ' '))
        attr.includes(':slot:') && (attr = attr.replace(/^:slot:/, 'v-slot:'))
        if (!attr.includes('=') && attr.includes('v-slot:')) return { key: attr, val: null }

        const i = attr.indexOf('=')
        attr = [attr.substr(0, i).trim(), attr.substr(i + 1).trim()].filter(t => t.length)
        return this.toVue(attr.shift(), attr.shift())
      }).filter(unit => unit)

      const attrs = {}
      for (let token of tokens)
        attrs[token.key] = token.key == 'class' && attrs[token.key] ? attrs[token.key] + ' ' + token.val : token.val

      const attr = ['']
      for (let key in attrs)
        attr.push(key + (attrs[key] !== null ? '="' + attrs[key] + '"' : ''))

      return {
        header: tmpHeader.header,
        space: space,
        tokens: attr.join(' '),
        children: [],
        toString () { return this.header[0] !== '|'
          ? 'area,base,br,col,command,embed,hr,img,input,keygen,link,meta,param,source,track,wbr'.split(/,/).indexOf(this.header) != -1
            ? '<' + this.header + this.tokens + ' />'
            : '<' + this.header + this.tokens + '>' + this.children.join('') + '</' + this.header + '>'
          : this.header.substr(1).trim()
        }
      }
    })

    const els = []
    const tmp = {}

    for (let line of lines) {
      const parent = tmp[line.space - 2]
      parent
        ? line.space > parent.space && parent.children.push(line)
        : els.push(line)
      tmp[line.space] = line
    }

    return els.join('')
  }
}

// Toastr
const Toastr = {
  items: [],
  close (item) { return item = this.items.indexOf(item), item == -1 || this.items.splice(item, 1), this },
  push (item) { return this.items.push(item), setTimeout(_ => this.close(item), 5000), this },
  failure: (title, content) => Toastr.push({ type: 'failure icon-26', title, content }),
  success: (title, content) => Toastr.push({ type: 'success icon-23', title, content }),
  // warning: (title, content) => Toastr.push({ type: 'warning icon-25', title, content }),
  // info: (title, content) => Toastr.push({ type: 'info icon-24', title, content })
}

const pad0 = (t, n = 2, c = '0') => {
  t = '' + t, c = '' + c, n = '' + Math.pow(10, n - 1)
  if (t.length > n.length) return t
  n = n.length - t.length
  return c.repeat(n) + t
}
const Datetime = function(datetime) {
  if (!(this instanceof Datetime)) return new Datetime(datetime)
  const [date, time = '00:00:00'] = datetime.split(' ')
  const [year, month, day] = date.split('-')
  const [hour, min, sec] = time.split(':')
  
  this.date  = new Date(year, month - 1, day, hour, min, sec)
  this.year  = this.date.getFullYear()
  this.month = this.date.getMonth() + 1
  this.day   = this.date.getDate()
  this.hour  = this.date.getHours()
  this.min   = this.date.getMinutes()
  this.sec   = this.date.getSeconds()
}
Datetime.prototype.toString = function() { return [[this.year, this.month, this.day].map(t => pad0(t, 2)).join('-'), [this.hour, this.min, this.sec].map(t => pad0(t, 2)).join(':')].join(' ') }
Object.defineProperty(Datetime.prototype, 'dateText', { get () { return this.year + '年' + this.month + '月' + this.day + '日' } })
Object.defineProperty(Datetime.prototype, 'timeText', { get () { return (this.hour != 12 ? this.hour != 0 ? this.hour > 12 ? this.hour > 18 ? '晚間' : '下午' : '上午' : '午夜' : '中午') + ' ' + (this.hour > 12 ? this.hour - 12 : this.hour) + '點' + this.min + '分' + this.sec + '秒' } })
Object.defineProperty(Datetime.prototype, 'datetimeText', { get () { return this.dateText + ' ' + this.timeText } })
Object.defineProperty(Datetime.prototype, 'ago', { get () {
    const d = (new Date().getTime() - this.date.getTime()) / 1000

    const c = [
      { b: 60,  f: '秒鐘前'},
      { b: 60, f: ' 分鐘前'},
      { b: 24, f: ' 小時前'},
      { b: 30, f: ' 天前'},
      { b: 12, f: ' 個月前'}]

    let u = 1
    for (let i = 0, t; i < c.length; i++, u = t) {
      t = c[i].b * u
      if (d < t) return parseInt(d / u, 10) + c[i].f
    }
    return parseInt(d / u, 10) + ' 年前'
} })

// Queue
const Queue = function(...closures) { if (!(this instanceof Queue)) return new Queue(...closures); else this.closures = [], this.prevs = [], this.isWorking = false, closures.forEach(this.enqueue.bind(this)) }
Queue.prototype = { ...Queue.prototype, 
  get size () { return this.closures.length },
  enqueue (closure) { return this.closures.push(closure), this.dequeue(...this.prevs), this },
  dequeue (...prevs) { if (this.isWorking) return this; else this.isWorking = true; if (this.closures.length) this.closures[0]((...prevs) => (this.prevs = prevs, this.closures.shift(), this.isWorking = false, this.dequeue(...this.prevs)), ...prevs); else this.isWorking = false; return this },
  push (closure) { return this.enqueue(closure) },
  pop (...prevs) { return this.dequeue(...prevs) },
  clean () { return this.closures = [], this.prevs = [], this.isWorking = false, this }
}

// Params
const Params = function(sets, query = true) {
  const tokens = query ? window.location.href.split('?').pop() : window.location.hash.substr(1)

  tokens.split('&').forEach(val => {

    const splitter = val.split('=')
    if (splitter.length != 2) return

    const k = decodeURIComponent(splitter[0])
    const v = decodeURIComponent(splitter[1])

    if (k.slice(-2) == '[]')
      if (!Params[k = k.slice(0, -2)]) Params[k] = [v]
      else Params[k].push(v)
    else Params[k] = v
  })

  for (var k in sets)
    Params[k] = Params[k] === undefined ? sets[k] : Params[k]

  return Params
}

// API
const API = function(url, data, option = {}) { if (!(this instanceof API)) return new API(url, data, option); else this.option = { ...option }, this.event = { done: null, fail: null, after: null }, this.url(url), this.method('get'), this.data(data) }
API.prototype.url    = function(url) { return this.option.url = url, this }
API.prototype.data   = function(data) { return this.option.data = data || {}, this }
API.prototype.method = function(method) { return typeof method == 'string' && (method = method.toLowerCase()) && ['get', 'post', 'put', 'delete'].includes(method) && (this.option.type = method.toUpperCase()), this }
API.prototype.header = function(header) { return this.option.headers = header, this }
API.prototype.before = function(before) { return typeof before == 'function' && (this.option.beforeSend = before), this }
API.prototype.done   = function(done) { return typeof done == 'function' && (this.event.done = done), this }
API.prototype.fail   = function(fail) { return typeof fail == 'function' && (this.event.fail = fail), this }
API.prototype.after  = function(after) { return typeof after == 'function' && (this.event.after = after), this }
API.prototype.auth   = function(user) { return this.header({ Authorization: 'Bearer ' + (user || Auth.user) }) }
API.prototype.send   = function() { return $.ajax(this.option).done(this.event.done).fail(({ status: code, responseJSON: { messages } = { messages: ['不明錯誤！'] } }) => this.event.fail && this.event.fail(messages, code)).complete(this.event.after), this }
API.GET = (url, data, option = {}) => API(url, data, option).method('get')
API.POST = (url, data, option = {}) => API(url, data, option).method('post')
API.PUT = (url, data, option = {}) => API(url, data, option).method('put')
API.DELETE = (url, data, option = {}) => API(url, data, option).method('delete')
API.Q = { q: Queue(), enqueue (closure) { return this.q.enqueue((...args) => (closure = closure(...args), closure instanceof API && closure.send())), this } }


// Load
const Load = {
  mount (option) { return document.body.appendChild(new Vue(option).$mount().$el) },
  init (option) { return typeof option == 'function' ? option() : $(_ => this.mount(option)) }
}

