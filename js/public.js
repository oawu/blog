// GA
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-46121102-6', 'auto');
ga('send', 'pageview');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */
(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = 'https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v3.2&appId=1033322433418965&autoLogAppEvents=1';fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));
!function(t){"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)}(function(t){function e(){var e=a(this),o=n.settings,s=t(this).data("tag");return isNaN(e.datetime)||(0==o.cutoff||r(e.datetime)<o.cutoff)&&(""==s||void 0===s?t(this).text(i(e.datetime)):t(this).data(s,i(e.datetime))),this}function a(e){if(!(e=t(e)).data("timeago")){e.data("timeago",{datetime:n.datetime(e)});var a=t.trim(e.text());n.settings.localeTitle?e.attr("title",e.data("timeago").datetime.toLocaleString()):!(a.length>0)||n.isTime(e)&&e.attr("title")||e.attr("title")}return e.data("timeago")}function i(t){return n.inWords(r(t))}function r(t){return(new Date).getTime()-t.getTime()}t.timeago=function(e){return i(e instanceof Date?e:"string"==typeof e?t.timeago.parse(e):"number"==typeof e?new Date(e):t.timeago.datetime(e))};var n=t.timeago;t.extend(t.timeago,{settings:{refreshMillis:0,allowFuture:!1,localeTitle:!1,cutoff:0,strings:{prefixAgo:null,prefixFromNow:"現在",suffixAgo:"之前",suffixFromNow:null,seconds:"不到 1 分鐘",minute:"約 1 分鐘",minutes:"%d 分鐘",hour:"約 1 小時",hours:"%d 小時",day:"約 1 天",days:"%d 天",month:"約 1 個月",months:"%d 個月",year:"約 1 年",years:"%d 年",numbers:[],wordSeparator:""}},inWords:function(e){function a(a,r){var n=t.isFunction(a)?a(r,e):a,o=i.numbers&&i.numbers[r]||r;return n.replace(/%d/i,o)}var i=this.settings.strings,r=i.prefixAgo,n=i.suffixAgo;this.settings.allowFuture&&e<0&&(r=i.prefixFromNow,n=i.suffixFromNow);var o=Math.abs(e)/1e3,s=o/60,u=s/60,m=u/24,d=m/365,l=o<45&&a(i.seconds,Math.round(o))||o<90&&a(i.minute,1)||s<45&&a(i.minutes,Math.round(s))||s<90&&a(i.hour,1)||u<24&&a(i.hours,Math.round(u))||u<42&&a(i.day,1)||m<30&&a(i.days,Math.round(m))||m<45&&a(i.month,1)||m<365&&a(i.months,Math.round(m/30))||d<1.5&&a(i.year,1)||a(i.years,Math.round(d)),f=i.wordSeparator||"";return void 0===i.wordSeparator&&(f=" "),t.trim([r,l,n].join(f))},parse:function(e){var a=t.trim(e);return a=a.replace(/\.\d+/,""),a=a.replace(/-/,"/").replace(/-/,"/"),a=a.replace(/T/," ").replace(/Z/," UTC"),a=a.replace(/([\+\-]\d\d)\:?(\d\d)/," $1$2"),a=a.replace(/([\+\-]\d\d)$/," $100"),new Date(a)},datetime:function(e){var a=n.isTime(e)?t(e).attr("datetime"):t(e).data("time");return n.parse(a)},isTime:function(e){return"time"===t(e).get(0).tagName.toLowerCase()}});var o={init:function(){var a=t.proxy(e,this);a();var i=n.settings;i.refreshMillis>0&&(this._timeagoInterval=setInterval(a,i.refreshMillis))},update:function(a){var i=n.parse(a);t(this).data("timeago",{datetime:i}),n.settings.localeTitle&&t(this).attr("title",i.toLocaleString()),e.apply(this)},updateFromDOM:function(){t(this).data("timeago",{datetime:n.parse(n.isTime(this)?t(this).attr("datetime"):t(this).attr("title"))}),e.apply(this)},dispose:function(){this._timeagoInterval&&(window.clearInterval(this._timeagoInterval),this._timeagoInterval=null)}};t.fn.timeago=function(t,e){var a=t?o[t]:o.init;if(!a)throw new Error("Unknown function name '"+t+"' for timeago");return this.each(function(){a.call(this,e)}),this},document.createElement("abbr"),document.createElement("time")});

function time() { return new Date().getTime(); }
function getStorage(key) { return (typeof Storage !== 'undefined') && (value = localStorage.getItem (key)) && (value = JSON.parse (value)) ? value : undefined; }
function setStorage(key, data) { try { if (typeof Storage === 'undefined') return false; localStorage.setItem (key, JSON.stringify (data)); return true; } catch (err) { console.error ('設定 storage 失敗！', error); return false; } }
function searchRun(objs, q) { q = typeof q === 'string' ? new RegExp(q, 'gi') : q.map(function(q) { return new RegExp('^' + q + '$', 'gi'); }); return objs.map(function(obj) { obj.s = obj.s.filter(function(s) { return !Array.isArray(q) ? !!(s.t.match(q) || s.d.match(q)) : s.h.filter(function(h) { return q.filter(function(q) { return h.match(q); }).length; }).length; }); return obj; }).filter(function(obj) { return obj.s.length; }); }
function searchItem(t) { return $('<a />').attr('href', t.u).append($('<figure />').attr('data-bgurl', t.i).css({'background-image': 'url(' + t.i + ')'})).append($('<b />').text(t.t)).append($('<div />').append($(t.h.map(function(t) { return $('<span />').text(t); })).map($.fn.toArray))).append($('<section />').text(t.d)).append($('<time />')); }
function searchItems(t) { return $('<div />').addClass('list').addClass(t.s.length > 10 ? 'min' : null).addClass('more').append($('<div />').append($('<span />').text(t.t)).append($('<a />').attr('href', t.u).text('更多…'))).append($(t.s.map(searchItem)).map($.fn.toArray)); }

$(function() {
  var $body = $('body');
  // if (function(){ return /iphone/gi.test(navigator.userAgent) && (screen.height == 812 && screen.width == 375); }())
  // $body.addClass('iPhoneX');

  var Header = {
    $el: $('#header'),
    key: 'ioa.header.ttl',
    ttl: 1000 * 60 * 60 * 24, // 1天
    set: function() {
      var val = getStorage(Header.key);
      var timer = setTimeout(function() {
        Header.$el.addClass('new');
      }, 2400);

      Header.$el.find('.oa-avatar').click(function() {
        Header.$el.removeClass('new');
        setStorage(Header.key, time());
      });

      if (!val || (time() >= val + Header.ttl))
        return;

      Header.$el.removeClass('new');
      clearTimeout(timer);
    }
  };

  Header.set();


  $('*[pubdate], *[editdate]').each(function() {
    $(this).attr('data-ago', $.timeago($(this).attr('datetime'))).empty();
  });

  $('*[data-bgurl]').each(function() {
    $(this).css({'background-image': 'url(' + $(this).data('bgurl') + ')'});
  });

  $('*.cnt').each(function() {
    $(this).addClass('n' + $(this).find('>*').length);
  });

  $('*[data-bc]').each(function() {
    $('<label />').addClass('_bc').attr('for', $(this).data('bc')).insertAfter($(this));
  });

  $('#info > a').each(function() {
    var text = $(this).text();
    var title = $(this).attr('title');
    $(this).empty().removeAttr('title').append($('<span />').attr('title', title).text(text));
  });

  $('article.panel > section').each(function() {
    $(this).find('> p > img').each(function() {
      var $parent = $(this).parent(),
          src = $(this).attr('src'),
          text = $(this).attr('alt'),
          $figure = $('<figure />');

      $figure.attr('data-bgurl', src).css({'background-image': 'url(' + src + ')'}).addClass(text.length ? 'desc' : null).append(
        $(this).clone()).append(
        text.length ? $('<figcaption />').addClass('icon-18').text(text) : null).insertBefore($parent);
    });

    $(this).find('> iframe').each(function() {
      var $that = $(this).clone(true);
      $('<div />').addClass('iframe').append($that).insertBefore($(this));
      $(this).remove();
    });

    $(this).addClass('show');
  });
  
  $('article.panel > section a[href]:not([target])').each(function() {
    $(this).attr('target', '_blank');
  });

  window.oaips = {
    inited: false,
    $oaips: null, $conter: null, callPvfunc : null,
    ni: 0, $objs: {},
    init: function($b, c) {
      if (window.oaips.inited)
        return this;

      if (typeof PhotoSwipe === 'function')
        window.oaips.inited = true;

      if (!window.oaips.inited)
        return this;

      this.$oaips = $('<div class="oaips"><div class="oaips__bg"></div><div class="oaips__scroll-wrap"><div class="oaips__container"><div class="oaips__item"></div><div class="oaips__item"></div><div class="oaips__item"></div></div><div class="oaips__ui oaips__ui--hidden"><div class="oaips__top-bar"><div class="oaips__counter"></div><button class="oaips__button oaips__button--close" title="關閉 (Esc)"></button><button class="oaips__button oaips__button--share" title="分享"></button><button class="oaips__button oaips__button--link" title="鏈結"></button><button class="oaips__button oaips__button--fs" title="全螢幕切換"></button><button class="oaips__button oaips__button--zoom" title="放大/縮小"></button><div class="oaips__preloader"><div class="oaips__preloader__icn"><div class="oaips__preloader__cut"><div class="oaips__preloader__donut"></div></div></div></div></div><div class="oaips__share-modal oaips__share-modal--hidden oaips__single-tap"><div class="oaips__share-tooltip"></div></div><button class="oaips__button oaips__button--arrow--left" title="上一張"></button><button class="oaips__button oaips__button--arrow--right" title="下一張"></button><div class="oaips__caption"><div class="oaips__caption__center"></div></div></div></div></div>').appendTo($b);
      this.$conter = this.$oaips.find('div.oaips__caption__center');
      if (c && typeof c === 'function')
        this.callPvfunc = c;

      return this;
    },
    show: function(index, $obj, da, fromURL) {
      if (!window.oaips.inited)
        return this;

      if (isNaN (index) || !window.oaips.$oaips || !window.oaips.$conter)
        return;

      var items = $obj.get(0).$objs.map(function() {
        var $img = $(this).find('img'),
            $figcaption = $(this).find('figcaption');

        return {
          w:       $img.get(0).width,
          h:       $img.get(0).height,
          src:     $(this).data('bgurl'),
          href:    $(this).data('bgurl'),

          title:   $figcaption.length ? $figcaption.html() : '',
          content: $figcaption.length ? $figcaption.html() : '',
          el:      $(this).get(0)
        };
      }).toArray();

      var options = {
        index:                 parseInt (index, 10) - (fromURL ? 1 : 0),
        galleryUID:            $obj.data('oaips-uid'),
        showHideOpacity:       true,
        showAnimationDuration: da ? 0 : 500,
        getThumbBoundsFn: function(index) {
          var pageYScroll = window.pageYOffset || document.documentElement.scrollTop, rect = items[index].el.getBoundingClientRect();

          return {
            x: rect.left,
            y: rect.top + pageYScroll, w:rect.width
          };
        }
      };

      var g = new PhotoSwipe(
        window.oaips.$oaips.get(0), PhotoSwipeUI_Default, items, options, $obj.get(0).$objs.map(function() {
        return $(this).data('pvid') ? $(this).data('pvid') : '';// $(this).data('id');
      }));

      g.init(function(pvid) {
        console.error(pvid);
      });

      window.oaips.$conter.width(Math.floor (g.currItem.w * g.currItem.fitRatio) - 20);

      g.listen('beforeChange', function() {
        window.oaips.$conter.removeClass('show');
        window.oaips.$conter.width(Math.floor(g.currItem.w * g.currItem.fitRatio - 20));
      });
      g.listen('afterChange', function() {
        window.oaips.$conter.addClass ('show');
      });
      g.listen('resize', function() {
        window.oaips.$conter.width(Math.floor(g.currItem.w * g.currItem.fitRatio - 20));
      });

      return this;
    },
    set: function(gs, fnx) {
      if (!window.oaips.inited)
        return this;

      var $obj = (gs instanceof jQuery) ? gs : $(gs);

      if (!$obj.length)
        return false;

      $obj.each(function(i) {
        var $that = $(this);

        $that.data('oaips-uid', window.oaips.ni + i + 1);

        $that.get(0).$objs = $that.find(fnx);

        $that.find(fnx).click(function() {
          window.oaips.show($that.get(0).$objs.index($(this)), $that);
        });

        window.oaips.$objs[window.oaips.ni + i] = $that;
      });

      window.oaips.ni = window.oaips.ni + 1;

      return this;
    },
    listenUrl: function() {
      if (!window.oaips.inited)
        return this;

      var params = {};
      
      window.location.hash.replace ('#', '').split ('&').forEach(function(t, i) {
        if (!(t && (t = t.split ('=')).length && t[1].length))
          return;
        params[t[0]] = t[1];
      });

      if (!window.oaips.$objs[params.gid - 1] || Object.keys (params).length === 0 || typeof params.gid === 'undefined' || typeof params.pid === 'undefined')
        return false;

      setTimeout(function() {
        window.oaips.show(params.pid - 1, window.oaips.$objs[params.gid - 1], true, true);
      }, 500);

      return this;
    }
  };

  window.oaips.init($body);
  window.oaips.set('section.md', 'figure[data-bgurl]');
  window.oaips.set('#pics', 'figure[data-bgurl]');

  var $search = $('#search'),
      url = new URL(location.href),
      n = url.pathname.substring(url.pathname.lastIndexOf('/') + 1), q = url.searchParams.get('q');

  if (n === 'search.html') {
    if (!(q && q.length))
      return window.location.replace(url.origin);

    if (q.match(/^tags?:(.*)/))
      q = q.match(/^tags?:(.*)/)[1].split(',').map(Function.prototype.call, String.prototype.trim);

    $('#q').val(decodeURIComponent(Array.isArray(q) ? 'tags:' + q.join(',') : q));

    var All = {
      key: 'ioa.all',
      api: $search.data('api'),
      ttl: 60 * 60 * 1000,
      get: function(ok, no) {
        var val = getStorage(All.key);
        if (val && val.time && (time() < val.time + All.ttl)) return ok && ok(val.content);
        return $.get(All.api, function(result) { setStorage(All.key, { time: time(), content: result }); return ok && ok(result); }).fail(no);
      }
    };

    All.get(
      function(result) { $search.attr('data-title', '找不到符合的資料。').append($(searchRun(result, q).map(searchItems)).map($.fn.toArray)); },
      function() { return window.location.replace(url.origin); });
  }

  window.oaips.listenUrl();
});