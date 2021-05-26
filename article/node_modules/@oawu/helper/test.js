/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2021, @oawu/helper
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */


const Helper = require('./index.js')
Helper.println('Hi~')

console.error(Helper.argv('-A', null));

const { Typeof } = Helper
Helper.println(Typeof.str.or({}, '?'))
