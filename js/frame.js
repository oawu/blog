/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */

$(function () {
  $('.avatar').OAimgLiquid ();
  $('.timeago').timeago ();

  var $flickr = $('.pin.flickr'),
      api_key = $flickr.children ('input[name="api_key"]').val (),
      photoset_id = $flickr.children ('input[name="photoset_id"]').val ();

  if ($flickr.length && api_key.length && photoset_id.length) {
    $.getJSON (
      "https://api.flickr.com/services/rest/?format=json&jsoncallback=?",
      {
        method: 'flickr.photosets.getPhotos',
        extras: 'url_s',
        api_key: api_key,
        photoset_id: photoset_id
      }
    )
    .done (function (data) {
      if (data.stat === 'ok') {

        var owner = data.photoset.owner;
        var title = data.photoset.title;
        var urls = data.photoset.photo.map (function (t, i) { return {id: t.id, url: t.url_s}; });
        if (!urls.length) { $flickr.remove (); return ; }

        var $box = $flickr.children ('.box').append (urls.map (function (t) { return $('<a />').attr ('href', 'https://www.flickr.com/photos/' + owner + '/' + t.id).attr ('target', '_blank').append ($('<img />').attr ('src', t.url)); }));

        var index = 0, flickr = function () {
          clearTimeout (timer);
          var $n = $box.find ('img').removeClass ('show').eq (index++)
          if ($n.length) $n.addClass ('show');
          else $box.find ('img').eq (index = 0).addClass ('show');
          timer = setTimeout (flickr, 3000)
        }, timer = setTimeout (flickr, 1);
      }
      if (title.length) $box.append ($('<a />').attr ('href', 'https://www.flickr.com/photos/' + owner + '/' + data.photoset.id).attr ('target', '_blank').append ($('<div />').addClass ('title').text (title)));
    })
    .fail (function () {
      $flickr.remove ();
    });
  } else {
    $flickr.remove ();
  }


  $('.oa-tree li:has(ul) > .folder').click (function () {
    var $ul = $(this).parent ('li').children ('ul'), $span = $(this).children ('span:first-child');

    if ($ul.length && ($span.text (!$ul.hasClass ("tree-show") ? $span.data ('open') : $span.data ('close'))))
      if ($ul.hasClass ("tree-show")) $ul.removeClass ('tree-show');
      else $ul.addClass ('tree-show');
  });

  $('.oa-tree li:first-child li:first-child li:first-child').parents ('ul').prev ('span').click ().parents ('ul').prev ('span');

  if (typeof (Storage) !== 'undefined') {
    var message = '', timeRange = 60 * 3, last = localStorage.getItem ('messages');
    if (last) {
      last = JSON.parse (last);
      message = (Math.abs ($.timeago.parse (new Date ().getFullYear () + '-' + (new Date ().getMonth () + 1) + '-' + new Date ().getDate () + ' ' + new Date ().getHours () + ':' + new Date ().getMinutes () + ':' + new Date ().getSeconds ())) - Math.abs ($.timeago.parse (last.d.Y + '-' + last.d.M + '-' + last.d.D + ' ' + last.d.h + ':' + last.d.m + ':' + last.d.s))) / 1000 < timeRange ? '' : ('你在' + jQuery.timeago (last.d.Y + '-' + last.d.M + '-' + last.d.D + ' ' + last.d.h + ':' + last.d.m + ':' + last.d.s, true) + '有來過喔！' + (last.n && last.n.length ? '<br/>你上次看的是：<b>' + last.n + '</b>': ''));
    } else {
      message = 'Hi, 這是你第一次光臨耶！';
    }
    if (message.length) {
      setTimeout (function () {
        var $message = $('.pin.oa_infos .message').html (message).removeClass ('hide');
        var obj = { v: last ? last.v + 1 : 1,
                    d: {Y: new Date ().getFullYear (), M: new Date ().getMonth () + 1, D: new Date ().getDate (), h: new Date ().getHours (), m: new Date ().getMinutes (), s: new Date ().getSeconds ()},
                    n: $message.data ('name') && $message.data ('name').length ? $message.data ('name') : (last ? last.n : ''),
                    h: last ? [window.location.pathname].concat (last.h) : [window.location.pathname]
                  };
        localStorage.setItem ('messages', JSON.stringify (obj));
        if (!$(window).scrollTop ()) {
          $(window).scroll (function () {
            $message.addClass ('hide');
          });
        } else {
          setTimeout (function () {
            $message.addClass ('hide');
          }, 10000);
        }
      }, 1000);
    }
  }
});