/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, @oawu/xterm
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

const Xterm = require('./index.js')

Xterm.stringPrototype()

console.log('黑'.black  + '|' + Xterm.black('黑')  + ' ' + '亮黑'.lightBlack  + '|' + Xterm.lightBlack('亮黑'))
console.log('紅'.red    + '|' + Xterm.red('紅')    + ' ' + '亮紅'.lightRed    + '|' + Xterm.lightRed('亮紅'))
console.log('綠'.green  + '|' + Xterm.green('綠')  + ' ' + '亮綠'.lightGreen  + '|' + Xterm.lightGreen('亮綠'))
console.log('黃'.yellow + '|' + Xterm.yellow('黃') + ' ' + '亮黃'.lightYellow + '|' + Xterm.lightYellow('亮黃'))
console.log('藍'.blue   + '|' + Xterm.blue('藍')   + ' ' + '亮藍'.lightBlue   + '|' + Xterm.lightBlue('亮藍'))
console.log('紫'.purple + '|' + Xterm.purple('紫') + ' ' + '亮紫'.lightPurple + '|' + Xterm.lightPurple('亮紫'))
console.log('青'.cyan   + '|' + Xterm.cyan('青')   + ' ' + '亮青'.lightCyan   + '|' + Xterm.lightCyan('亮青'))
console.log('灰'.gray   + '|' + Xterm.gray('灰')   + ' ' + '亮灰'.lightGray   + '|' + Xterm.lightGray('亮灰'))

console.log()
console.log('灰'.bgBlack  + '|' + Xterm.bgBlack('灰')  + ' ' + '亮灰'.bgLightBlack  + '|' + Xterm.bgLightBlack('亮灰'))
console.log('灰'.bgRed    + '|' + Xterm.bgRed('灰')    + ' ' + '亮灰'.bgLightRed    + '|' + Xterm.bgLightRed('亮灰'))
console.log('灰'.bgGreen  + '|' + Xterm.bgGreen('灰')  + ' ' + '亮灰'.bgLightGreen  + '|' + Xterm.bgLightGreen('亮灰'))
console.log('灰'.bgYellow + '|' + Xterm.bgYellow('灰') + ' ' + '亮灰'.bgLightYellow + '|' + Xterm.bgLightYellow('亮灰'))
console.log('灰'.bgBlue   + '|' + Xterm.bgBlue('灰')   + ' ' + '亮灰'.bgLightBlue   + '|' + Xterm.bgLightBlue('亮灰'))
console.log('灰'.bgPurple + '|' + Xterm.bgPurple('灰') + ' ' + '亮灰'.bgLightPurple + '|' + Xterm.bgLightPurple('亮灰'))
console.log('灰'.bgCyan   + '|' + Xterm.bgCyan('灰')   + ' ' + '亮灰'.bgLightCyan   + '|' + Xterm.bgLightCyan('亮灰'))
console.log('灰'.bgGray   + '|' + Xterm.bgGray('灰')   + ' ' + '亮灰'.bgLightGray   + '|' + Xterm.bgLightGray('亮灰'))

console.log()
console.log('粗'.blod + Xterm.blod('粗'))
console.log('細'.dim + Xterm.dim('細'))
console.log('斜'.italic + Xterm.italic('斜'))
console.log('底'.underline + Xterm.underline('底'))
console.log('連'.blink + Xterm.blink('連'))
console.log('反'.inverted + Xterm.inverted('反'))
console.log('隱'.hidden + Xterm.hidden('隱'))
