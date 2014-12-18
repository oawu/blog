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


});