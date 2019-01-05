<!DOCTYPE html>
<html lang="zh-Hant">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">

    <title><?php echo ($articles->text() ? $articles->text() . ' - ' : '') . TITLE;?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/public.css">

    <script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/jquery-1.12.4.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/public.js"></script>
  </head>
  <body>
    <input type="checkbox" id="menu-ckb" class="_ckbh">
    <input type="checkbox" id="info-ckb" class="_ckbh">
    
    <?php echo $_header;?>
    <?php echo $_menu;?>

    <main id="main"><div>
      <div class="list"><?php
      echo implode('', array_map(function($item) {

        $aAttrs = [
          'href' => $item->url(),
        ];
        $figureAttrs = [
          'data-bgurl' => $item->iconImage,
        ];
        $imgAttrs = [
          'alt' => $item->title . ' - ' . TITLE,
          'src' => $item->iconImage
        ];

        $return = '';
        $return .= '<a' . attr($aAttrs) . '>';
          $return .= '<figure' . attr($figureAttrs) . '>';
            $return .= '<img' . attr($imgAttrs) . '/>';
            $return .= '<figcaption>' . $item->title . '</figcaption>';
          $return .= '</figure>';
          $return .= '<b>' . $item->title . '</b>';
          $return .= '<div>' . implode('', array_map(function($t) { return '<span>' . $t . '</span>'; }, $item->tags)) . '</div>';
          $return .= '<section>' . $item->description . '</section>';
          $return .= '<time datetime="' . $item->createAt->format('Y-m-d') . '" date="' . $item->createAt->format('Y.m.d') . '" pubdate="pubdate">' . $item->createAt->format('Y.m.d') . '</time>';

        $return .= '</a>';
        return $return;
      }, $page->items()));?></div>
      <div class="page"><span><?php echo $page->pagination();?></span></div>
    </div></main>

    <?php echo $_info;?>

    <div id="fb-root"></div>
  </body>
</html>