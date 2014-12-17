/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */

$(function () {
  $('.avatar').OAimgLiquid ();
  // $('.pin.flickr').

  $.getJSON (
    "https://api.flickr.com/services/rest/?format=json&method=flickr.photosets.getPhotos&photoset_id=72157644160529292&extras=url_s&api_key=09dc017022847889346d048182b9515f&jsoncallback=?",
    function (data) {
      if (data.stat === 'ok') {

        var owner = data.photoset.owner;
        var title = data.photoset.title;
        var urls = data.photoset.photo.map (function (t, i) { return {id: t.id, url: t.url_s}; }); 
        if (!urls.length) { $('.pin.flickr').remove (); return ; }

        var $box = $('.pin.flickr .box').append (urls.map (function (t) { return $('<a />').attr ('href', 'https://www.flickr.com/photos/' + owner + '/' + t.id).attr ('target', '_blank').append ($('<img />').attr ('src', t.url)); }));
        
        var index = 0, flickr = function () {
          clearTimeout (timer);
          var $n = $box.find ('img').removeClass ('show').eq (index++)
          if ($n.length) $n.addClass ('show');
          else $box.find ('img').eq (index = 0).addClass ('show');
          timer = setTimeout (flickr, 3000)
        }, timer = setTimeout (flickr, 1);
      }
      if (title.length) $box.append ($('<a />').attr ('href', 'https://www.flickr.com/photos/' + owner + '/' + data.photoset.id).attr ('target', '_blank').append ($('<div />').addClass ('title').text (title)));
    });

});