/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, @oawu/cli-progress
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

const Progress = require('./index.js')
const Xterm = require('@oawu/xterm')

let index = 0

const test1 = _ => {
  process.stdout.write("\n")

  Progress.title('標題', '副標題')
  Progress.total(10)

  setTimeout(_ => {
    Progress.advance
    
    setTimeout(_ => {
      Progress.advance

      setTimeout(_ => {
        Progress.advance

        setTimeout(_ => {
          Progress.advance.done()

          test2()
        }, 100)
      }, 100)
    }, 100)
  }, 100)
}
const test2 = _ => {
  process.stdout.write("\n")

  Progress.title('標題', '副標題 1', '副標題 2')
  Progress.total(10)

  setTimeout(_ => {
    Progress.advance
    
    setTimeout(_ => {
      Progress.advance

      setTimeout(_ => {
        Progress.advance

        setTimeout(_ => {
          Progress.advance.fail()
          test3()
        }, 100)
      }, 100)
    }, 100)
  }, 100)
}
const test3 = _ => {
  process.stdout.write("\n")

  Progress.title('標題')
  Progress.total(2)

  setTimeout(_ => {
    Progress.advance
    
    setTimeout(_ => {
      Progress.advance

      setTimeout(_ => {
        Progress.advance

        setTimeout(_ => {
          Progress.advance.done('ok')
          test4()
        }, 100)
      }, 100)
    }, 100)
  }, 100)
}
const test4 = _ => {
  process.stdout.write("\n")

  Progress.title()
  Progress.total(2)

  setTimeout(_ => {
    Progress.advance
    
    setTimeout(_ => {
      Progress.advance

      setTimeout(_ => {
        Progress.advance

        setTimeout(_ => {
          index++
          Progress.advance.fail('GG' + index)
          if (index == 1) test1(Progress.option.color = true)
          else if (index == 2) test1(Progress.option.header = '.')
          else if (index == 3) test1(Progress.option.header.color = Xterm.cyan)
          else if (index == 4) test1(Progress.option.newline = '.')
          else if (index == 5) test1(Progress.option.newline.color = Xterm.cyan)
          else if (index == 6) test1(Progress.option.dash = '.')
          else if (index == 7) test1(Progress.option.dash.color = Xterm.cyan)
          else if (index == 8) test1(Progress.option.dot = '.')
          else if (index == 9) test1(Progress.option.dot.color = Xterm.cyan)
          else if (index == 10) test1(Progress.option.loading = '12345')
          else if (index == 11) test1(Progress.option.loading.color = Xterm.cyan)
          else if (index == 12) test1(Progress.option.done.color = Xterm.cyan)
          else if (index == 13) test1(Progress.option.fail.color = Xterm.cyan)
          else if (index == 14) test1(Progress.option.index.color = Xterm.cyan)
          else if (index == 15) test1(Progress.option.title.color = Xterm.cyan)
          else if (index == 16) test1(Progress.option.subtitle.color = Xterm.cyan)
          else if (index == 17) test1(Progress.option.percent.color = Xterm.cyan)
          else if (index == 18) test1(Progress.option.space = 1)
          else process.stdout.write("OK!\n")
        }, 100)
      }, 100)
    }, 100)
  }, 100)
}

test1()

// Progress.title('標題', '副標題')
// Progress.total(3)

// setTimeout(_ => {
//   Progress.advance
  
//   setTimeout(_ => {
//     Progress.advance

//     setTimeout(_ => {
//       Progress.done()
//     }, 1000)
//   }, 1000)
// }, 1000)

// Progress.option.color = true // 使用顏色
// Progress.option.done.color = text => Xterm.lightBlue(text).dim() // done 時顯示為細體藍色
// Progress.option.fail.color = Xterm.red // fail 時為紅色
// Progress.option.header = '➜' // 主標題符號改為 `➜`
// Progress.option.header.color = Xterm.lightGray // 主標題符號顏色改為亮灰色

// // 開始執行
// Progress.title('標題', '副標題')
// Progress.total(3)

// setTimeout(_ => {
//   Progress.advance
  
//   setTimeout(_ => {
//     Progress.advance

//     setTimeout(_ => {
//       Progress.done()
//     }, 1000)
//   }, 1000)
// }, 1000)

