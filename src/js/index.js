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
    figure => *if=el.e=='img'   *bind=attr
      img => *bind=attr

    pre => *else-if=el.e=='pre'   *bind=attr   :is=el.e
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
        h1 => *text=article.title
        span => *text=article.subtitle   *if=article.subtitle

      section
        el => *for=(el, i) in article.els   :key=i   :el=el

        template => *if=article.r.length
          h2 => *text='相關參考'
          el => *for=(el, i) in article.r   :key=i   :el=el

      div#prev-next => *if=article.other   :class='n' + Object.keys(article.other).length
        a.icon-a.prev => *if=article.other.prev   :href=article.other.prev.url
          span => *text='上一篇'
          b => *text=article.other.prev.title
        a.icon-b.next => *if=article.other.next   :href=article.other.next.url
          span => *text='下一篇'
          b => *text=article.other.next.title
      
      footer
        time => *text=Datetime(article.at).ago   :datetime=Datetime(article.at)
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
        a => *for=(article, i) in articles   :key=i   :href=article.url
          b => *text=article.title
          span => *if=article.subtitle   *text=article.subtitle`)
})

Vue.component('main-albums', {
  props: {
    title: { type: String, required: true },
    albums: { type: Array, required: true },
  },
  template: El.render(`
    div#albums
      header
        h1 => *text=title

      div.albums
        a => *for=(album, i) in albums   :key=i   :href=album.url
          b => *text=album.title
          span => *if=album.subtitle   *text=album.subtitle`)
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
        // span         => *text='，或者'
        // label.icon-1 => *text='搜尋'
        span         => *text='吧！'`)
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
      { key: 'index',   icon: 'd',  title: '個人簡介', subtitle: 0 },
      { key: 'dev',     icon: 'e',  title: '開發心得', subtitle: 0 },
      { key: 'mac',     icon: '1b', title: '蘋果環境', subtitle: 0 },
      { key: 'aws',     icon: '22', title: 'AWS筆記', subtitle: 0 },
      { key: 'rpi',     icon: '29', title: '樹莓派',  subtitle: 0 },
      { key: 'note',    icon: '1e', title: '隨筆雜記', subtitle: 0 },
      { key: 'mazu',    icon: '1a', title: '鄉土北港', subtitle: 0 },
      { key: 'unbox',   icon: 'f',  title: '開箱文章', subtitle: 0 },
      // { key: 'album',   icon: '14', title: '生活相簿', subtitle: 0 },
      { key: 'license', icon: '16', title: '授權聲明', subtitle: 0 }
    ],
  },
  mounted () {
    this.load(this.items
      .map(t => (t.url = 'index' + EXT + '?k=' + t.key, t))
      .filter(({ key }) => Params.k === key).shift() || this.items[0])
  },
  methods: {
    load (item) {
      API.Q
        .enqueue(next => next(this.item = item))
        .enqueue(next => API.GET('/api/' + this.item.key + '.json').fail(_ => this.is404 = true).done(next))
        .enqueue((next, main) => {
          if (!main.items) return next(main)
          
          const i = main.items
            .map(item => (item.url = '/index' + EXT + '?k=' + this.item.key + '&id=' + item.id, item))
            .map(({ id }) => id)
            .indexOf(decodeURI(Params.id))

          if (i == -1) return next(main, Params.id && Toastr.failure('找不到資料！'))

          const item = main.items[i]
          const p = i == 0 ? null : main.items[i - 1]
          const n = i == main.items.length - 1 ? null : main.items[i + 1]
          const other = {}
          p && (other.prev = p)
          n && (other.next = n)

          return item ? API.GET('/api/' + this.item.key + '/' + item.id + '.json').done(main => next({ ...main, other })).fail(_ => next(main, Toastr.failure('找不到資料！'))) : next(main)
        })
        .enqueue((next, main) => next(this.main = main))
        .enqueue(next => next(this.items.forEach(item => API.GET('/api/' + item.key + '.json').done(({ items = 0 }) => item.subtitle = items && items.length).send())))
    }
  },
  template: El.render(`
    main#app
      toastr

      div#menu => :class={ on: on }
        a => *for=t in items   :key=t.k   :class=['icon-' + t.icon, { active: item === t }]   :href=t.url
          span => *text=t.title   :text=t.subtitle

      header#header
        label.icon-0 => @click=on=true
        span => *text=title

      label#cover => *if=on   @click=on=false

      div#main
        p404 => *if=is404

        template => *else
          loading => *if=!main

          template => *else
            main-articles => *if=main.type=='articles'   :title=main.title   :articles=main.items
            main-article  => *if=main.type=='article'    :article=main
            main-albums   => *if=main.type=='albums'     :title=main.title   :albums=main.items
  `)
})
