"use strict";function _readOnlyError(a){throw new TypeError("\""+a+"\" is read-only")}function _toConsumableArray(a){return _arrayWithoutHoles(a)||_iterableToArray(a)||_unsupportedIterableToArray(a)||_nonIterableSpread()}function _nonIterableSpread(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}function _iterableToArray(a){if("undefined"!=typeof Symbol&&null!=a[Symbol.iterator]||null!=a["@@iterator"])return Array.from(a)}function _arrayWithoutHoles(a){if(Array.isArray(a))return _arrayLikeToArray(a)}function ownKeys(a,b){var c=Object.keys(a);if(Object.getOwnPropertySymbols){var d=Object.getOwnPropertySymbols(a);b&&(d=d.filter(function(b){return Object.getOwnPropertyDescriptor(a,b).enumerable})),c.push.apply(c,d)}return c}function _objectSpread(a){for(var b,c=1;c<arguments.length;c++)b=null==arguments[c]?{}:arguments[c],c%2?ownKeys(Object(b),!0).forEach(function(c){_defineProperty(a,c,b[c])}):Object.getOwnPropertyDescriptors?Object.defineProperties(a,Object.getOwnPropertyDescriptors(b)):ownKeys(Object(b)).forEach(function(c){Object.defineProperty(a,c,Object.getOwnPropertyDescriptor(b,c))});return a}function _defineProperty(a,b,c){return b in a?Object.defineProperty(a,b,{value:c,enumerable:!0,configurable:!0,writable:!0}):a[b]=c,a}function _construct(){return _construct=_isNativeReflectConstruct()?Reflect.construct:function(b,c,d){var e=[null];e.push.apply(e,c);var a=Function.bind.apply(b,e),f=new a;return d&&_setPrototypeOf(f,d.prototype),f},_construct.apply(null,arguments)}function _isNativeReflectConstruct(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch(a){return!1}}function _setPrototypeOf(a,b){return _setPrototypeOf=Object.setPrototypeOf||function(a,b){return a.__proto__=b,a},_setPrototypeOf(a,b)}function _slicedToArray(a,b){return _arrayWithHoles(a)||_iterableToArrayLimit(a,b)||_unsupportedIterableToArray(a,b)||_nonIterableRest()}function _nonIterableRest(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}function _iterableToArrayLimit(a,b){var c=a&&("undefined"!=typeof Symbol&&a[Symbol.iterator]||a["@@iterator"]);if(null!=c){var d,e,f=[],g=!0,h=!1;try{for(c=c.call(a);!(g=(d=c.next()).done)&&(f.push(d.value),!(b&&f.length===b));g=!0);}catch(a){h=!0,e=a}finally{try{g||null==c["return"]||c["return"]()}finally{if(h)throw e}}return f}}function _arrayWithHoles(a){if(Array.isArray(a))return a}function _createForOfIteratorHelper(a,b){var c="undefined"!=typeof Symbol&&a[Symbol.iterator]||a["@@iterator"];if(!c){if(Array.isArray(a)||(c=_unsupportedIterableToArray(a))||b&&a&&"number"==typeof a.length){c&&(a=c);var d=0,e=function(){};return{s:e,n:function n(){return d>=a.length?{done:!0}:{done:!1,value:a[d++]}},e:function e(a){throw a},f:e}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var f,g=!0,h=!1;return{s:function s(){c=c.call(a)},n:function n(){var a=c.next();return g=a.done,a},e:function e(a){h=!0,f=a},f:function f(){try{g||null==c["return"]||c["return"]()}finally{if(h)throw f}}}}function _unsupportedIterableToArray(a,b){if(a){if("string"==typeof a)return _arrayLikeToArray(a,b);var c=Object.prototype.toString.call(a).slice(8,-1);return"Object"===c&&a.constructor&&(c=a.constructor.name),"Map"===c||"Set"===c?Array.from(a):"Arguments"===c||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(c)?_arrayLikeToArray(a,b):void 0}}function _arrayLikeToArray(a,b){(null==b||b>a.length)&&(b=a.length);for(var c=0,d=Array(b);c<b;c++)d[c]=a[c];return d}/**
 * @author      OA Wu <oawu.tw@gmail.com>
 * @copyright   Copyright (c) 2015 - 2022, Lalilo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */ // Local Storage
var Data={enable:"undefined"!=typeof Storage&&"undefined"!=typeof localStorage&&"undefined"!=typeof JSON,set:function set(a,b){return this.enable&&localStorage.setItem(a,JSON.stringify({val:b})),this},get:function get(a){return this.enable&&(a=localStorage.getItem(a))?JSON.parse(a).val:null}},El={splitLength:3,split:function split(a,b){var c=a.match(b);return c?(b=a.indexOf(c[0]),c=c.shift(),{header:a.substring(0,b).trim(),tokens:a.substring(b+c.length).trim(),match:c}):{header:a.trim(),tokens:"",match:""}},toVue:function toVue(a,b){return a&&b?{key:a.replace(/^\*/,"v-").replace(/^@/,"v-on:"),val:b.replace(/"/g,"'")}:null},render:function render(a){var b,c=this,d=a.split("\n").filter(function(a){return a.trim().length}).map(function(a){var b,d=a.search(/\S|$/),e=c.split(a,/\s+=\>\s+/gm),f=c.split(e.header,/\.|#/gm),g=(e.tokens+(f.match+f.tokens).replace(/#/gm," ".repeat(c.splitLength)+"#").replace(/\./gm," ".repeat(c.splitLength)+".")).split(new RegExp("\\s{"+c.splitLength+",}","gm")).map(function(a){if("*else"===a)return{key:"v-else",val:null};if("#"!==a[0]||a.includes("=")||(a="id="+a.substr(1)),"."!==a[0]||a.includes("=")||(a="class="+a.substr(1).replace("."," ")),a.includes(":slot:")&&(a=a.replace(/^:slot:/,"v-slot:")),!a.includes("=")&&a.includes("v-slot:"))return{key:a,val:null};var b=a.indexOf("=");return a=[a.substr(0,b).trim(),a.substr(b+1).trim()].filter(function(a){return a.length}),c.toVue(a.shift(),a.shift())}).filter(function(a){return a}),h={},i=_createForOfIteratorHelper(g);try{for(i.s();!(b=i.n()).done;){var k=b.value;h[k.key]="class"==k.key&&h[k.key]?h[k.key]+" "+k.val:k.val}}catch(a){i.e(a)}finally{i.f()}var j=[""];for(var l in h)j.push(l+(null===h[l]?"":"=\""+h[l]+"\""));return{header:f.header,space:d,tokens:j.join(" "),children:[],toString:function toString(){return"|"===this.header[0]?this.header.substr(1).trim():-1=="area,base,br,col,command,embed,hr,img,input,keygen,link,meta,param,source,track,wbr".split(/,/).indexOf(this.header)?"<"+this.header+this.tokens+">"+this.children.join("")+"</"+this.header+">":"<"+this.header+this.tokens+" />"}}}),e=[],f={},g=_createForOfIteratorHelper(d);try{for(g.s();!(b=g.n()).done;){var h=b.value,i=f[h.space-2];i?h.space>i.space&&i.children.push(h):e.push(h),f[h.space]=h}}catch(a){g.e(a)}finally{g.f()}return e.join("")}},Toastr={items:[],close:function close(a){return a=this.items.indexOf(a),-1==a||this.items.splice(a,1),this},push:function push(a){var b=this;return this.items.push(a),setTimeout(function(){return b.close(a)},5e3),this},failure:function failure(a,b){return Toastr.push({type:"failure icon-26",title:a,content:b})},success:function success(a,b){return Toastr.push({type:"success icon-23",title:a,content:b})}// warning: (title, content) => Toastr.push({ type: 'warning icon-25', title, content }),
// info: (title, content) => Toastr.push({ type: 'info icon-24', title, content })
},pad0=function(a){var b=1<arguments.length&&void 0!==arguments[1]?arguments[1]:2,d=2<arguments.length&&void 0!==arguments[2]?arguments[2]:"0";return(a=""+a,d=""+d,b=""+Math.pow(10,b-1),a.length>b.length)?a:(b=b.length-a.length,d.repeat(b)+a)},Datetime=function(a){if(!(this instanceof Datetime))return new Datetime(a);var b=a.split(" "),c=_slicedToArray(b,2),d=c[0],e=c[1],f=void 0===e?"00:00:00":e,g=d.split("-"),h=_slicedToArray(g,3),i=h[0],j=h[1],k=h[2],l=f.split(":"),m=_slicedToArray(l,3),n=m[0],o=m[1],p=m[2];this.date=new Date(i,j-1,k,n,o,p),this.year=this.date.getFullYear(),this.month=this.date.getMonth()+1,this.day=this.date.getDate(),this.hour=this.date.getHours(),this.min=this.date.getMinutes(),this.sec=this.date.getSeconds()};// Element
Datetime.prototype.toString=function(){return[[this.year,this.month,this.day].map(function(a){return pad0(a,2)}).join("-"),[this.hour,this.min,this.sec].map(function(a){return pad0(a,2)}).join(":")].join(" ")},Object.defineProperty(Datetime.prototype,"dateText",{get:function get(){return this.year+"\u5E74"+this.month+"\u6708"+this.day+"\u65E5"}}),Object.defineProperty(Datetime.prototype,"timeText",{get:function get(){return(12==this.hour?"\u4E2D\u5348":0==this.hour?"\u5348\u591C":12<this.hour?18<this.hour?"\u665A\u9593":"\u4E0B\u5348":"\u4E0A\u5348")+" "+(12<this.hour?this.hour-12:this.hour)+"\u9EDE"+this.min+"\u5206"+this.sec+"\u79D2"}}),Object.defineProperty(Datetime.prototype,"datetimeText",{get:function get(){return this.dateText+" "+this.timeText}}),Object.defineProperty(Datetime.prototype,"ago",{get:function get(){for(var a,b=(new Date().getTime()-this.date.getTime())/1e3,d=[{b:60,f:"\u79D2\u9418\u524D"},{b:60,f:" \u5206\u9418\u524D"},{b:24,f:" \u5C0F\u6642\u524D"},{b:30,f:" \u5929\u524D"},{b:12,f:" \u500B\u6708\u524D"}],c=1,e=0;e<d.length;e++,c=a)if(a=d[e].b*c,b<a)return parseInt(b/c,10)+d[e].f;return parseInt(b/c,10)+" \u5E74\u524D"}});// Queue
var Queue=function(){for(var a=arguments.length,b=Array(a),c=0;c<a;c++)b[c]=arguments[c];return this instanceof Queue?void(this.closures=[],this.prevs=[],this.isWorking=!1,b.forEach(this.enqueue.bind(this))):_construct(Queue,b)};Queue.prototype=_objectSpread(_objectSpread({},Queue.prototype),{},{get size(){return this.closures.length},enqueue:function enqueue(a){return this.closures.push(a),this.dequeue.apply(this,_toConsumableArray(this.prevs)),this},dequeue:function dequeue(){var a,b=this;if(this.isWorking)return this;this.isWorking=!0;for(var c=arguments.length,d=Array(c),e=0;e<c;e++)d[e]=arguments[e];return this.closures.length?(a=this.closures)[0].apply(a,[function(){for(var a=arguments.length,c=Array(a),d=0;d<a;d++)c[d]=arguments[d];return b.prevs=c,b.closures.shift(),b.isWorking=!1,b.dequeue.apply(b,_toConsumableArray(b.prevs))}].concat(d)):this.isWorking=!1,this},push:function push(a){return this.enqueue(a)},pop:function pop(){return this.dequeue.apply(this,arguments)},clean:function clean(){return this.closures=[],this.prevs=[],this.isWorking=!1,this}});// Params
var Params=function(a){var b=!(1<arguments.length&&void 0!==arguments[1])||arguments[1],c=b?window.location.href.split("?").pop():window.location.hash.substr(1);for(var d in c.split("&").forEach(function(a){var b=a.split("=");if(2==b.length){var c=decodeURIComponent(b[0]),d=decodeURIComponent(b[1]);"[]"==c.slice(-2)?Params[(c.slice(0,-2),_readOnlyError("k"))]?Params[c].push(d):Params[c]=[d]:Params[c]=d}}),a)Params[d]=void 0===Params[d]?a[d]:Params[d];return Params},API=function(a,b){var c=2<arguments.length&&arguments[2]!==void 0?arguments[2]:{};return this instanceof API?void(this.option=_objectSpread({},c),this.event={done:null,fail:null,after:null},this.url(a),this.method("get"),this.data(b)):new API(a,b,c)};// API
API.prototype.url=function(a){return this.option.url=a,this},API.prototype.data=function(a){return this.option.data=a||{},this},API.prototype.method=function(a){return"string"==typeof a&&(a=a.toLowerCase())&&["get","post","put","delete"].includes(a)&&(this.option.type=a.toUpperCase()),this},API.prototype.header=function(a){return this.option.headers=a,this},API.prototype.before=function(a){return"function"==typeof a&&(this.option.beforeSend=a),this},API.prototype.done=function(a){return"function"==typeof a&&(this.event.done=a),this},API.prototype.fail=function(a){return"function"==typeof a&&(this.event.fail=a),this},API.prototype.after=function(a){return"function"==typeof a&&(this.event.after=a),this},API.prototype.auth=function(a){return this.header({Authorization:"Bearer "+(a||Auth.user)})},API.prototype.send=function(){var a=this;return $.ajax(this.option).done(this.event.done).fail(function(b){var c=b.status,d=b.responseJSON;d=void 0===d?{messages:["\u4E0D\u660E\u932F\u8AA4\uFF01"]}:d;var e=d.messages;return a.event.fail&&a.event.fail(e,c)}).complete(this.event.after),this},API.GET=function(a,b){var c=2<arguments.length&&arguments[2]!==void 0?arguments[2]:{};return API(a,b,c).method("get")},API.POST=function(a,b){var c=2<arguments.length&&arguments[2]!==void 0?arguments[2]:{};return API(a,b,c).method("post")},API.PUT=function(a,b){var c=2<arguments.length&&arguments[2]!==void 0?arguments[2]:{};return API(a,b,c).method("put")},API.DELETE=function(a,b){var c=2<arguments.length&&arguments[2]!==void 0?arguments[2]:{};return API(a,b,c).method("delete")},API.Q={q:Queue(),enqueue:function enqueue(a){return this.q.enqueue(function(){return a=a.apply(void 0,arguments),a instanceof API&&a.send()}),this}};// Load
var Load={mount:function mount(a){return document.body.appendChild(new Vue(a).$mount().$el)},init:function init(a){var b=this;return"function"==typeof a?a():$(function(){return b.mount(a)})}};