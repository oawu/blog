# OA's Node Helper

一些常用的小工具 🤝


## 說明
很簡單就是一個 OA 個人 [Node.js](https://nodejs.org/) 的 [npm](https://www.npmjs.com/) 小幫手！

## 安裝

```shell
npm install @oawu/helper
```

## 使用

引入 `require('@oawu/helper')` 即可使用，如下範例：

```javascript

  const Helper = require('@oawu/helper')
  Helper.println('Hi~')

  const { Typeof } = Helper
  Helper.println(Typeof.str.or({}, '?'))

```


## 說明

目前可使用的功能如下：

* `clean` ─ 清空終端機畫面
* `println` ─ 很單純就是 **印出後換行**
* `scanDir` ─ 掃描指定的目錄，第二參數決定是否掃瞄子目錄，第二參數預設為 `true`
* `exists` ─ 檢查路徑是否存在
* `mkdir` ─ 建立目錄，第二參數決定是否遞迴建立，第二參數預設為 `false`
* `access` ─ 檢查路徑是否擁有權限，預設為 **讀取權限**
* `isDirectory` ─ 檢查路徑是否為目錄
* `isFile` ─ 檢查路徑是否為檔案
* `isSub` ─ 檢查第一參數是否為第二字參數的子字串
* `verifyDirs` ─ 檢查在路徑下的目錄是否存在，不存在則依序建立，第一參數為路徑，第二參數為路徑陣列
* `argv` ─ 取得此次 node 指令的參數，第一參數為名稱，第二參數為預設值
* `Typeof` ─ 檢查與處理格式，參考以下說明

### Typeof

* `func` ─ 檢查格式是否為 `function`，回傳值為 `true` 或 `false`
* `bool` ─ 檢查格式是否為 `boolean`，回傳值為 `true` 或 `false`
* `object` ─ 檢查格式是否為 `object`，回傳值為 `true` 或 `false`
* `str` ─ 檢查格式是否為 `string`，回傳值為 `true` 或 `false`
* `num` ─ 檢查格式是否為 `number`，回傳值為 `true` 或 `false`
* `arr` ─ 檢查格式是否為 `array`，回傳值為 `true` 或 `false`
* `str.notEmpty` ─ 檢查格式是否為 `string` 並且長度大於 0，回傳值為 `true` 或 `false`
* `arr.notEmpty` ─ 檢查格式是否為 `array` 並且數量大於 0，回傳值為 `true` 或 `false`

* `func.or` ─ 功能與 `func` 功能相同，當值 **非 `function`** 時，則回傳第二參數值
* `bool.or` ─ 功能與 `bool` 功能相同，當值 **非 `boolean`** 時，則回傳第二參數值
* `object.or` ─ 功能與 `object` 功能相同，當值 **非 `object`** 時，則回傳第二參數值
* `str.or` ─ 功能與 `str` 功能相同，當值 **非 `string`** 時，則回傳第二參數值
* `num.or` ─ 功能與 `num` 功能相同，當值 **非 `number`** 時，則回傳第二參數值
* `arr.or` ─ 功能與 `arr` 功能相同，當值 **非 `array`** 時，則回傳第二參數值
* `str.notEmpty.or` ─ 功能與 `str.notEmpty` 功能相同，當值 **非 `string` 或長度為 0** 時，則回傳第二參數值
* `arr.notEmpty.or` ─ 功能與 `arr.notEmpty` 功能相同，當值 **非 `array` 或數量為 0** 時，則回傳第二參數值

* `func.do` ─ 第二參數為 closure，功能與 `func` 功能相同，符合條件下即執行第二參數，並且回傳值為函式回傳值
* `bool.do` ─ 第二參數為 closure，功能與 `bool` 功能相同，符合條件下即執行第二參數，並且回傳值為函式回傳值
* `object.do` ─ 第二參數為 closure，功能與 `object` 功能相同，符合條件下即執行第二參數，並且回傳值為函式回傳值
* `str.do` ─ 第二參數為 closure，功能與 `str` 功能相同，符合條件下即執行第二參數，並且回傳值為函式回傳值
* `num.do` ─ 第二參數為 closure，功能與 `num` 功能相同，符合條件下即執行第二參數，並且回傳值為函式回傳值
* `arr.do` ─ 第二參數為 closure，功能與 `arr` 功能相同，符合條件下即執行第二參數，並且回傳值為函式回傳值
* `str.notEmpty.do` ─ 第二參數為 closure，功能與 `str.notEmpty` 功能相同，符合條件下即執行第二參數，並且回傳值為函式回傳值
* `arr.notEmpty.do` ─ 第二參數為 closure，功能與 `arr.notEmpty` 功能相同，符合條件下即執行第二參數，並且回傳值為函式回傳值

* `func.do.or` ─ 第二參數為 closure，功能與 `func` 功能相同，符合條件下即執行第二參數，回傳值為函式回傳值，若不符合條件，則回傳值為第三參數值
* `bool.do.or` ─ 第二參數為 closure，功能與 `bool` 功能相同，符合條件下即執行第二參數，回傳值為函式回傳值，若不符合條件，則回傳值為第三參數值
* `object.do.or` ─ 第二參數為 closure，功能與 `object` 功能相同，符合條件下即執行第二參數，回傳值為函式回傳值，若不符合條件，則回傳值為第三參數值
* `str.do.or` ─ 第二參數為 closure，功能與 `str` 功能相同，符合條件下即執行第二參數，回傳值為函式回傳值，若不符合條件，則回傳值為第三參數值
* `num.do.or` ─ 第二參數為 closure，功能與 `num` 功能相同，符合條件下即執行第二參數，回傳值為函式回傳值，若不符合條件，則回傳值為第三參數值
* `arr.do.or` ─ 第二參數為 closure，功能與 `arr` 功能相同，符合條件下即執行第二參數，回傳值為函式回傳值，若不符合條件，則回傳值為第三參數值
* `str.notEmpty.do.or` ─ 第二參數為 closure，功能與 `str.notEmpty` 功能相同，符合條件下即執行第二參數，回傳值為函式回傳值，若不符合條件，則回傳值為第三參數值
* `arr.notEmpty.do.or` ─ 第二參數為 closure，功能與 `arr.notEmpty` 功能相同，符合條件下即執行第二參數，回傳值為函式回傳值，若不符合條件，則回傳值為第三參數值
