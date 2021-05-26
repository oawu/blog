
const Path = require('path')
Path.root = Path.resolve(__dirname, ('..' + Path.sep).repeat(0)) + Path.sep


const Axios = require('axios')
const Form  = require('form-data')
const { main: Queue } = require('@oawu/queue')
const html2json = require('html2json').html2json
const { parse } = require('node-html-parser')
const FileSystem = require('fs')

// const form  = new Form()

const urls = [
  {
    key: 'dev',
    icon: 'e',
    title: '開發心得',
    pages: [
      { key: 'AWS-EC2-Lock-SSH',                          url: 'https://www.ioa.tw/Develop/AWS-EC2-Lock-SSH.html' },
      { key: 'iOS-create-CocoaPods',                      url: 'https://www.ioa.tw/Develop/iOS-create-CocoaPods.html' },
      { key: 'FullStack-2019-Baishatun-GPS',              url: 'https://www.ioa.tw/Develop/FullStack-2019-Baishatun-GPS.html' },
      { key: 'iOS-CocoaPods-note',                        url: 'https://www.ioa.tw/Develop/iOS-CocoaPods-note.html' },
      { key: 'macOS-High-Sierra-install-PHP-Apache-note', url: 'https://www.ioa.tw/Develop/macOS-High-Sierra-install-PHP-Apache-note.html' },
      { key: '2017-LINE-Taiwan-TechPulse',                url: 'https://www.ioa.tw/Develop/2017-LINE-Taiwan-TechPulse.html' },
      { key: 'F2E-Firebase-LiveMaps',                     url: 'https://www.ioa.tw/Develop/F2E-Firebase-LiveMaps.html' },
      { key: 'GoogleMaps-Marker-Clustering',              url: 'https://www.ioa.tw/Develop/GoogleMaps-Marker-Clustering.html' },
      { key: 'GoogleSheets-API',                          url: 'https://www.ioa.tw/Develop/GoogleSheets-API.html' },
      { key: 'F2E-PokemonGo-StopMaps',                    url: 'https://www.ioa.tw/Develop/F2E-PokemonGo-StopMaps.html' },
      { key: 'FullStack-Taipei-Activities',               url: 'https://www.ioa.tw/Develop/FullStack-Taipei-Activities.html' },
      { key: 'F2E-2016-Taipei-Child-Art-Festival',        url: 'https://www.ioa.tw/Develop/F2E-2016-Taipei-Child-Art-Festival.html' },
      { key: 'F2E-Number-Flipping-Counter',               url: 'https://www.ioa.tw/Develop/F2E-Number-Flipping-Counter.html' },
      { key: 'FullStack-Browser-Console-QRcode',          url: 'https://www.ioa.tw/Develop/FullStack-Browser-Console-QRcode.html' },
      { key: 'FullStack-2016-LiuFangMazu-GPS',            url: 'https://www.ioa.tw/Develop/FullStack-2016-LiuFangMazu-GPS.html' },
      { key: 'FullStack-2016-Mazu-GPS',                   url: 'https://www.ioa.tw/Develop/FullStack-2016-Mazu-GPS.html' },
      { key: 'FullStack-2016-Haotien-GPS',                url: 'https://www.ioa.tw/Develop/FullStack-2016-Haotien-GPS.html' },
      { key: 'case-Hoga',                                 url: 'https://www.ioa.tw/Develop/case-Hoga.html' },
      { key: 'case-VG',                                   url: 'https://www.ioa.tw/Develop/case-VG.html' },
      { key: 'FullStack-2016-Baishatun-GPS',              url: 'https://www.ioa.tw/Develop/FullStack-2016-Baishatun-GPS.html' },
      { key: 'jQuery-ScrollView-extend',                  url: 'https://www.ioa.tw/Develop/jQuery-ScrollView-extend.html' },
      { key: 'FullStack-2016-ZEUS-Design-Studio',         url: 'https://www.ioa.tw/Develop/FullStack-2016-ZEUS-Design-Studio.html' },
      { key: 'F2E-TaipeiTowns',                           url: 'https://www.ioa.tw/Develop/F2E-TaipeiTowns.html' },
      { key: 'case-Bto',                                  url: 'https://www.ioa.tw/Develop/case-Bto.html' },
      { key: 'F2E-Theta-S-360',                           url: 'https://www.ioa.tw/Develop/F2E-Theta-S-360.html' },
      { key: 'GoogleMaps-Point-in-Polygon',               url: 'https://www.ioa.tw/Develop/GoogleMaps-Point-in-Polygon.html' },
      { key: 'GoogleMaps-MarkerMenu',                     url: 'https://www.ioa.tw/Develop/GoogleMaps-MarkerMenu.html' },
      { key: 'PHP-ElasticSearch-PDO',                     url: 'https://www.ioa.tw/Develop/PHP-ElasticSearch-PDO.html' },
      { key: 'FullStack-Weather-Maps',                    url: 'https://www.ioa.tw/Develop/FullStack-Weather-Maps.html' },
      { key: 'iOS-OAHUD',                                 url: 'https://www.ioa.tw/Develop/iOS-OAHUD.html' },
      { key: 'iOS-CatMap',                                url: 'https://www.ioa.tw/Develop/iOS-CatMap.html' },
      { key: 'GoogleMaps-Instagram-ImageMaps',            url: 'https://www.ioa.tw/Develop/GoogleMaps-Instagram-ImageMaps.html' },
      { key: 'GoogleMaps-Richman-Game',                   url: 'https://www.ioa.tw/Develop/GoogleMaps-Richman-Game.html' },
      { key: 'case-OFNA',                                 url: 'https://www.ioa.tw/Develop/case-OFNA.html' },
      { key: 'case-Harmonize',                            url: 'https://www.ioa.tw/Develop/case-Harmonize.html' },
      { key: 'Flickr-Search-API',                         url: 'https://www.ioa.tw/Develop/Flickr-Search-API.html' },
      { key: 'jQuery-Youtube-Player',                     url: 'https://www.ioa.tw/Develop/jQuery-Youtube-Player.html' },
      { key: 'GitHub-Blog',                               url: 'https://www.ioa.tw/Develop/GitHub-Blog.html' },
      { key: 'F2E-Material-Web-Design',                   url: 'https://www.ioa.tw/Develop/F2E-Material-Web-Design.html' },
      { key: 'jQuery-Navbar-extend',                      url: 'https://www.ioa.tw/Develop/jQuery-Navbar-extend.html' },
      { key: 'jQuery-Maze-Game',                          url: 'https://www.ioa.tw/Develop/jQuery-Maze-Game.html' },
      { key: 'case-Chitorch',                             url: 'https://www.ioa.tw/Develop/case-Chitorch.html' },
      { key: 'jQuery-scrollSliderView-extend',            url: 'https://www.ioa.tw/Develop/jQuery-scrollSliderView-extend.html' },
      { key: 'jQuery-imgLiquid-extend',                   url: 'https://www.ioa.tw/Develop/jQuery-imgLiquid-extend.html' },
      { key: 'PHP-2014-OACI',                             url: 'https://www.ioa.tw/Develop/PHP-2014-OACI.html' },
      { key: 'C-language-ComicBook',                      url: 'https://www.ioa.tw/Develop/C-language-ComicBook.html' },
      { key: 'PHP-Blog',                                  url: 'https://www.ioa.tw/Develop/PHP-Blog.html' },
      { key: 'jQuery-Pokemon-Game',                       url: 'https://www.ioa.tw/Develop/jQuery-Pokemon-Game.html' },
      { key: 'PHP-Album',                                 url: 'https://www.ioa.tw/Develop/PHP-Album.html' },
      { key: 'Arduino-Competition',                       url: 'https://www.ioa.tw/Develop/Arduino-Competition.html' },
      { key: 'Java-Assembler',                            url: 'https://www.ioa.tw/Develop/Java-Assembler.html' },
      { key: 'Java-Plurker',                              url: 'https://www.ioa.tw/Develop/Java-Plurker.html' },
      { key: 'Java-Msn',                                  url: 'https://www.ioa.tw/Develop/Java-Msn.html' },
      { key: 'Java-Painter',                              url: 'https://www.ioa.tw/Develop/Java-Painter.html' },
    ]
  },
  {
    key: 'mac',
    icon: '1b',
    title: '蘋果環境',
    pages: [
      { key: 'Base',            url: 'https://www.ioa.tw/macOS/Base.html' },
      { key: 'Chrome',          url: 'https://www.ioa.tw/macOS/Chrome.html' },
      { key: 'HackFont',        url: 'https://www.ioa.tw/macOS/HackFont.html' },
      { key: 'iTerm2',          url: 'https://www.ioa.tw/macOS/iTerm2.html' },
      { key: 'SublimeText',     url: 'https://www.ioa.tw/macOS/SublimeText.html' },
      { key: 'Sourcetree',      url: 'https://www.ioa.tw/macOS/Sourcetree.html' },
      { key: 'BetterTouchTool', url: 'https://www.ioa.tw/macOS/BetterTouchTool.html' },
      { key: 'GitSetting',      url: 'https://www.ioa.tw/macOS/GitSetting.html' },
      { key: 'Apache',          url: 'https://www.ioa.tw/macOS/Apache.html' },
      { key: 'PHP',             url: 'https://www.ioa.tw/macOS/PHP.html' },
      { key: 'MySQL',           url: 'https://www.ioa.tw/macOS/MySQL.html' },
      { key: 'SequelPro',       url: 'https://www.ioa.tw/macOS/SequelPro.html' },
      { key: 'RubyOnRails',     url: 'https://www.ioa.tw/macOS/RubyOnRails.html' },
      { key: 'Compass',         url: 'https://www.ioa.tw/macOS/Compass.html' },
      { key: 'Node',            url: 'https://www.ioa.tw/macOS/Node.js.html' },
      { key: 'CocoaPods',       url: 'https://www.ioa.tw/macOS/CocoaPods.html' },
      { key: 'Redis',           url: 'https://www.ioa.tw/macOS/Redis.html' },
      { key: 'Memcached',       url: 'https://www.ioa.tw/macOS/Memcached.html' },
      { key: 'Sip',             url: 'https://www.ioa.tw/macOS/Sip.html' },
      { key: 'MacDown',         url: 'https://www.ioa.tw/macOS/MacDown.html' },
      { key: 'Other',           url: 'https://www.ioa.tw/macOS/Other.html' },
    ]
  },
  {
    key: 'aws',
    icon: '22',
    title: 'AWS筆記',
    pages: [
      { key: 'Create-EC2-Instance',    url: 'https://www.ioa.tw/AWS/Create-EC2-Instance.html' },
      { key: 'Create-Elastic-IPs',     url: 'https://www.ioa.tw/AWS/Create-Elastic-IPs.html' },
      { key: 'EC2-Ubuntu',             url: 'https://www.ioa.tw/AWS/EC2-Ubuntu.html' },
      { key: 'EC2-Ubuntu-Apache',      url: 'https://www.ioa.tw/AWS/EC2-Ubuntu-Apache.html' },
      { key: 'EC2-Ubuntu-PHP',         url: 'https://www.ioa.tw/AWS/EC2-Ubuntu-PHP.html' },
      { key: 'EC2-Ubuntu-LetsEncrypt', url: 'https://www.ioa.tw/AWS/EC2-Ubuntu-LetsEncrypt.html' },
      { key: 'EC2-Ubuntu-MySQL',       url: 'https://www.ioa.tw/AWS/EC2-Ubuntu-MySQL.html' },
    ]
  },
  {
    key: 'note',
    icon: '1e',
    title: '隨筆雜記',
    pages: [
    ]
  },
  {
    key: 'mazu',
    icon: '1a',
    title: '鄉土北港',
    pages: [
      { key: '祖媽-金順盛-轎班會',                       url: 'https://www.ioa.tw/Mazu/祖媽-金順盛-轎班會.html' },
      { key: '二媽-金順安-轎班會',                       url: 'https://www.ioa.tw/Mazu/二媽-金順安-轎班會.html' },
      { key: '三媽-金盛豐-轎班會',                       url: 'https://www.ioa.tw/Mazu/三媽-金盛豐-轎班會.html' },
      { key: '四媽-金安瀾-轎班會',                       url: 'https://www.ioa.tw/Mazu/四媽-金安瀾-轎班會.html' },
      { key: '五媽-金豐隆-轎班會',                       url: 'https://www.ioa.tw/Mazu/五媽-金豐隆-轎班會.html' },
      { key: '六媽-金順崇-轎班會',                       url: 'https://www.ioa.tw/Mazu/六媽-金順崇-轎班會.html' },
      { key: '莊儀團-千順將軍',                       url: 'https://www.ioa.tw/Mazu/莊儀團-千順將軍.html' },
      { key: '虎爺會',                       url: 'https://www.ioa.tw/Mazu/虎爺會.html' },
      { key: '金瑞昭-註生娘娘',                       url: 'https://www.ioa.tw/Mazu/金瑞昭-註生娘娘.html' },
      { key: '金福綏-土地公會',                       url: 'https://www.ioa.tw/Mazu/金福綏-土地公會.html' },
      { key: '金垂髫-太子爺會',                       url: 'https://www.ioa.tw/Mazu/金垂髫-太子爺會.html' },
      { key: '震威團',                       url: 'https://www.ioa.tw/Mazu/震威團.html' },
      { key: '彌勒團',                       url: 'https://www.ioa.tw/Mazu/彌勒團.html' },
      { key: '閭山堂-神童團',                       url: 'https://www.ioa.tw/Mazu/閭山堂-神童團.html' },
      { key: '報馬仔',                       url: 'https://www.ioa.tw/Mazu/報馬仔.html' },
      { key: '聖震聲',                       url: 'https://www.ioa.tw/Mazu/聖震聲.html' },
      { key: '金聲順',                       url: 'https://www.ioa.tw/Mazu/金聲順.html' },
      { key: '鑾駕',                       url: 'https://www.ioa.tw/Mazu/鑾駕.html' },
      { key: '路關牌與爐主燈',                       url: 'https://www.ioa.tw/Mazu/路關牌與爐主燈.html' },
      { key: '錦陞社',                       url: 'https://www.ioa.tw/Mazu/錦陞社.html' },
      { key: '集斌社',                       url: 'https://www.ioa.tw/Mazu/集斌社.html' },
      { key: '集雅軒',                       url: 'https://www.ioa.tw/Mazu/集雅軒.html' },
      { key: '麗聲樂團',                       url: 'https://www.ioa.tw/Mazu/麗聲樂團.html' },
      { key: '北港媽祖的信仰在於正念',                       url: 'https://www.ioa.tw/Mazu/北港媽祖的信仰在於正念.html' },
      { key: '朝天宮的五爪金龍',                       url: 'https://www.ioa.tw/Mazu/朝天宮的五爪金龍.html' },
      { key: '如何分辨文轎與武轎',                       url: 'https://www.ioa.tw/Mazu/如何分辨文轎與武轎.html' },
      { key: '如何處理神轎的受損',                       url: 'https://www.ioa.tw/Mazu/如何處理神轎的受損.html' },
      { key: '虎爺也怕炸彈',                       url: 'https://www.ioa.tw/Mazu/虎爺也怕炸彈.html' },
      { key: '媽祖出入廟時住持法師在念什麼？',                       url: 'https://www.ioa.tw/Mazu/媽祖出入廟時住持法師在念什麼？.html' },
      { key: '是只進不退的北港媽祖神轎',                       url: 'https://www.ioa.tw/Mazu/是只進不退的北港媽祖神轎.html' },
      { key: '炸轎-北港炸轎的由來',                       url: 'https://www.ioa.tw/Mazu/炸轎-北港炸轎的由來.html' },
      { key: '犁炮-古式犁轎踩炮',                       url: 'https://www.ioa.tw/Mazu/犁炮-古式犁轎踩炮.html' },
      { key: '轎堵-Y字型轎堵的由來',                       url: 'https://www.ioa.tw/Mazu/轎堵-Y字型轎堵的由來.html' },
      { key: '轎錢-北港媽祖的轎錢與篙錢',                       url: 'https://www.ioa.tw/Mazu/轎錢-北港媽祖的轎錢與篙錢.html' },
    ]
  },
  {
    key: 'unbox',
    icon: 'f',
    title: '開箱文章',
    pages: [
      { key: 'Nintendo-Switch',                url: 'https://www.ioa.tw/Unboxing/Nintendo-Switch.html' },
      { key: 'PORTER-AMAZE-2WAY',              url: 'https://www.ioa.tw/Unboxing/PORTER-AMAZE-2WAY.html' },
      { key: 'Plantronics-BackBeat-FIT',       url: 'https://www.ioa.tw/Unboxing/Plantronics-BackBeat-FIT.html' },
      { key: 'SAILOR-REGLUS-pen',              url: 'https://www.ioa.tw/Unboxing/SAILOR-REGLUS-pen.html' },
      { key: 'Apple-Watch-Sport',              url: 'https://www.ioa.tw/Unboxing/Apple-Watch-Sport.html' },
      { key: 'PORTER-TANKER-3WAY',             url: 'https://www.ioa.tw/Unboxing/PORTER-TANKER-3WAY.html' },
      { key: 'vivosmart-HR',                   url: 'https://www.ioa.tw/Unboxing/vivosmart-HR.html' },
      { key: 'Apple-iPad-with-Retina-Display', url: 'https://www.ioa.tw/Unboxing/Apple-iPad-with-Retina-Display.html' },
      { key: 'SYM-GT125',                      url: 'https://www.ioa.tw/Unboxing/SYM-GT125.html' },
    ]
  }
]

const cover = nodes => nodes.map(node => {
  let child = node.child || []
  let attr = node.attr || {}
  Object.keys(attr).length || (attr = null)

  let tag = node.tag || 'span'
  
  if (tag == 'strong')
    tag = 'b'

  let obj = { e: tag }

  if (attr)
    obj.attr = attr

  if (tag == 'a' && obj.attr && obj.attr.href)
    obj.attr.target = '_blank'

  if (node.node == 'element')
    if (child.length == 1 && child[0].node == 'text')
      if (child[0].text === '')
        return null
      else
        return obj.t = child[0].text, obj
    else
      return obj.s = cover(child || []), obj
  else if (node.node == 'text')
    if (node.text !== '\n')
      return obj.t = node.text, obj
    else
      return null
  else
    return null
}).filter(t => t)

const objs = []

for (let group of urls) {
  // const obj = { t: group.title, s: [] }
  const s = []

  for (let page of group.pages) {
    Queue.enqueue(next => {
      Axios({
        baseURL: encodeURI(page.url),
        method: 'get',
      }).then(({ data }) => {

        data = parse(data)
        const title = data.querySelector('h1').text
        const section = data.querySelector('section').childNodes.join("").toString()
        const tags = data.querySelector('.tags').childNodes.map(c => c.text)
        const timeAt = data.querySelector('time[pubdate]').text.slice(0, 10)
        let [article, res = ''] = section.split('<h3>相關參考</h3>')
        

        article = html2json(article)
        res = html2json(res)

        article = cover(article.child)
        res = cover(res.child)


        FileSystem.writeFile(Path.root + 'api' + Path.sep + group.key + Path.sep + page.key + '.json', JSON.stringify({ k: page.key, t: title, i: timeAt, a: article, r: res, g: tags }), 'utf8', err => {
          if (err)
            return console.error('error!' + err);

          console.error(group.key, page.key, title)
          next(s.push({ k: page.key, t: title, i: timeAt, g: tags }))
        })
      })
    })
  }

  Queue.enqueue(next => {
    console.error(group.key + ' --- ok');

    FileSystem.writeFile(Path.root + 'api' + Path.sep + group.key + '.json', JSON.stringify({ t: group.title, s }), 'utf8', err => {
      if (err)
        return console.error('error!' + err);

      next()
    })
  })
}
// Queue.enqueue(next => FileSystem.writeFile(Path.root + 'a.json', JSON.stringify(objs), 'utf8', err => {
//   console.error(err);
// }))


































// FileSystem.readFile('text.text', 'utf8', (error, data) => {
//   data = data.split("\n")


//   const objs = []
//   for (let i = 0; i * 6 < data.length; i++) {
//     let [_, name, title, timeAt, article, res] = data.slice(i * 6, (i + 1) * 6)
    
//     article (article)
//     res = html2json(res)


//     article = cover(article.child)
//     res = cover(res.child)

//     objs.push({ name, title, timeAt, article, res })
//   }
//   FileSystem.writeFile('a.json', JSON.stringify(objs), 'utf8', err => {
//     console.error(err);
//   })

//   // let [name, title, timeAt, article, res] = data.split('\n')

//   // article = html2json(article)
//   // res = html2json(res)

//   // const cover = nodes => nodes.map(node => {
//   //   let child = node.child || []
//   //   let attr = node.attr || {}
//   //   Object.keys(attr).length || (attr = null)

//   //   let tag = node.tag || 'span'
    
//   //   if (tag == 'strong')
//   //     tag = 'b'

//   //   let obj = { e: tag }

//   //   if (attr)
//   //     obj.attr = attr

//   //   if (node.node == 'element')
//   //     if (child.length == 1 && child[0].node == 'text')
//   //       if (child[0].text === '') return null
//   //       else return obj.t = child[0].text, obj
//   //     else
//   //       return obj.s = cover(child || []), obj
//   //   else if (node.node == 'text')
//   //     return obj.t = node.text, obj
//   //   else
//   //     return null
//   // }).filter(t => t)

//   // article = cover(article.child)
//   // res = cover(res.child)

//   // // const parse = (nodes, i = 0) => nodes.map(node => {
//   // //   const tag = node.tag.charAt(0).toUpperCase() + node.tag.slice(1)

//   // //   if (node.text !== undefined) {
//   // //     if (tag == 'A') {
//   // //       return ' '.repeat(i) + tag + "('" + node.text + "')" + (node.attr && node.attr.href ? ".href('" + node.attr.href + "')" : '')
//   // //     }
//   // //     return ' '.repeat(i) + tag + "('" + node.text + "')"
//   // //   }

//   // //     // return ' '.repeat(i) + 'Span(' + node.text + ')'
//   // //   if (node.tag == 'iframe')
//   // //     return node.attr && node.attr.src
//   // //       ? ' '.repeat(i) + 'Iframe' + "('" + node.attr.src + "')"
//   // //       : null

//   // //   if (node.tag == 'img') 
//   // //     return node.attr && node.attr.src
//   // //       ? ' '.repeat(i) + 'Figure' + "('" + node.attr.src + "')" + (node.attr.alt ? ".attr({ alt: '" + node.attr.alt + "\' })" : '')
//   // //       : null

//   // //   return ' '.repeat(i) + tag + "(\n" + parse(node.child, i + 2).join(",\n") + '\n' + ' '.repeat(i) + ')'
//   // // }).filter(t => t)

//   // FileSystem.writeFile('a.json', JSON.stringify({ name, title, timeAt, article, res }), 'utf8', err => {
//   //   console.error(err);
//   // })
    
  
  
// })
