/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

Params({ k: 'index', id: null })

Vue.component('el', {
  props: { el: { type: Object, required: true } },
  methods: {
    copy (e, str) {
      const el = document.createElement('textarea')
      el.className = 'copy'
      el.value = str
      document.body.appendChild(el)
      el.select()

      try {
        document.execCommand('copy')
        Toastr.success('複製成功！', e == 'code' ? str : '')
      } catch (_) {
        Toastr.failure('複製失敗…')
      }

      document.body.removeChild(el)
    }
  },
  computed: {
    attr() {
      let clas = this.el.class || null
      clas = clas ? { class: clas } : {}

      let href = this.el.href || null
      href = href ? { href, target: "_blank" } : {}

      let src = this.el.src || null
      src = src ? { src } : {}

      let alt = this.el.alt || null
      alt = alt ? { alt } : {}

      let attr = this.el.attr || null
      attr = attr ? { ...attr } : {}

      return { ...attr, ...clas, ...href, ...src, ...alt, ...attr }
    }
  },
  template: El.render(`
    component => *if=el.e=='pre'   *bind=attr   :is=el.e
      label => *if=el.copy   @click=copy(el.e, el.copy)
      div => *if=el.s
        el => *for=(el, i) in el.s   :key=i   :el=el
      div => *else   *text=el.t

    component => *else-if=el.s   *bind=attr   :is=el.e
      el => *for=(el, i) in el.s   :key=i   :el=el
    component => *else-if=el.copy   *text=el.t   *bind=attr   :is=el.e   @click=copy(el.e, el.copy)   :copy=true
    component => *else   *text=el.t   *bind=attr   :is=el.e
    `)
})

Vue.component('main-article', {
  props: { article: { type: Object, required: true } },
  template: El.render(`
    article#article
      header
        h1 => *text=article.t
        span => *text=article.st   *if=article.st

      section
        el => *for=(el, i) in article.a   :key=i   :el=el

        template => *if=article.r.length
          h2 => *text='相關參考'
          el => *for=(el, i) in article.r   :key=i   :el=el

      div#prev-next => *if=article.p || article.n   :class='n' + [article.p, article.n].filter(t => t).length
        a.icon-a.prev => *if=article.p   :href=article.p.u
          span => *text='上一篇'
          b => *text=article.p.t
        a.icon-b.next => *if=article.n   :href=article.n.u
          span => *text='下一篇'
          b => *text=article.n.t
      
      footer
        time => *text=Datetime(article.i).ago   :datetime=Datetime(article.i)
      `)

})

Vue.component('main-articles', {
  props: {
    title: { type: String, required: true },
    articles: { type: Array, required: true },
  },
  template: El.render(`
    div#articles
      header
        h1 => *text=title

      div.articles
        a => *for=(article, i) in articles   :key=i   :href=article.u
          b => *text=article.t
          span => *if=article.st   *text=article.st`)
})

Vue.component('loading', {
  props: { text: { type: String, default: '讀取中，請稍候…', required: true } },
  template: El.render(`
    div#loading
      div.activity
        i => *for=i in [0, 1, 2, 3, 4, 5, 6, 7]   :class='n' + i
      span => *text=text`)
})

Vue.component('p404', {
  template: El.render(`
    div#p404
      i.icon-1d
      b    => *text='404'
      span => *text='您要找的頁面好像不見惹…'
      p
        span         => *text='建議您回'
        a.icon-d     => *text='首頁'   :href='/'
        span         => *text='，或者'
        label.icon-1 => *text='搜尋'
        span         => *text='一下吧！'`)
})

Vue.component('toastr', {
  data: _ => ({ toastrs: Toastr.items }),
  template: El.render(`
    div#toastr => *if=toastrs.length
      div.toastr => *for=(item, i) in toastrs   :key=item._id   :class=item.type
        b => *if=item.title   *text=item.title
        span => *if=item.content   *text=item.content
        label.icon-c => @click=Toastr.close(item)
        i`)
})

Load.init({
  data: {
    main: null,
    is404: false,
    on: false,

    title: "OA Wu's Blog",
    item: null,
    items: [
      { k: 'index',   st: 0, c: 'd', t: '個人簡介' },
      { k: 'dev',     st: 0, c: 'e', t: '開發心得' },
      { k: 'mac',     st: 0, c: '1b', t: '蘋果環境' },
      { k: 'aws',     st: 0, c: '22', t: 'AWS筆記' },
      { k: 'note',    st: 0, c: '1e', t: '隨筆雜記' },
      { k: 'mazu',    st: 0, c: '1a', t: '鄉土北港' },
      { k: 'unbox',   st: 0, c: 'f', t: '開箱文章' },
      { k: 'license', st: 0, c: '16', t: '授權聲明' }
    ],
  },
  mounted () {
    this.load(this.items.map(t => (t.u = 'index' + EXT + '?k=' + t.k, t)).filter(({ k }) => Params.k === k).shift() || this.items[0])
  },
  methods: {
    load (item) {
      API.Q
        .enqueue(next => next(this.item = item))
        .enqueue(next => API.GET('/api/' + this.item.k + '.json').fail(_ => this.is404 = true).done(next))
        .enqueue((next, main) => {
          if (!main.s) return next(main)
          
          const i = main.s.map(t => (t.u = '/index' + EXT + '?k=' + this.item.k + '&id=' + t.k, t)).map(({ k }) => k).indexOf(decodeURI(Params.id))

          if (i == -1) return next(main, Params.id && Toastr.failure('找不到資料！'))

          const item = main.s[i]
          const p = i == 0 ? null : main.s[i - 1]
          const n = i == main.s.length - 1 ? null : main.s[i + 1]
          return item ? API.GET('/api/' + this.item.k + '/' + item.k + '.json').done(main => next({ ...main, p, n })).fail(_ => next(main, Toastr.failure('找不到資料！'))) : next(main)
        })
        .enqueue((next, main) => next(this.main = main))
        .enqueue(next => next(this.items.forEach(item => API.GET('/api/' + item.k + '.json').done(({ s }) => item.st = s && s.length).send())))
    }
  },
  template: El.render(`
    main#app
      toastr

      div#menu => :class={ on: on }
        a => *for=t in items   :key=t.k   :class=['icon-' + t.c, { active: item === t }]   :href=t.u
          span => *text=t.t   :text=t.st

      header#header
        label.icon-0 => @click=on=true
        span => *text=title

      label#cover => *if=on   @click=on=false

      div#main
        p404 => *if=is404

        template => *else
          loading => *if=!main

          template => *else
            main-articles => *if=main.s   :title=main.t   :articles=main.s
            main-article => *if=main.a   :article=main
  `)
})
