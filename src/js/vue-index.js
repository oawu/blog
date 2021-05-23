/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

Load.init({
  data: {
  },
  mounted () {
  },
  computed: {
  },
  methods: {
  },
  template: El.render(`
    main#app
      div#menu
        div
          label.item => *text='個人簡介'

        div => :header='工程師日常'
          label.subtitle
            span => *text='開發心得'
            span => *text='開發心得'
          label.subtitle
            span => *text='蘋果環境'
            span => *text='蘋果環境'
          label.subtitle
            span => *text='AWS筆記'
            span => *text='AWS筆記'
          label.subtitle
            span => *text='隨筆雜記'
            span => *text='隨筆雜記'

        div => :header='個人日常'
          label.subtitle
            span => *text='鄉土北港'
            span => *text='鄉土北港'
          label.subtitle
            span => *text='開箱文章'
            span => *text='開箱文章'
          label.subtitle
            span => *text='生活相簿'
            span => *text='生活相簿'

        div
          label.item => *text='授權聲明'
      
      div#main
        div.item => *text='aaa'

      `)
})
