<!DOCTYPE html>
<html lang="zh-Hant">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">

    <title><?php echo ($album->title ? $album->title . ' - ' : '') . TITLE;?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/oaips.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/public.css">

    <script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/jquery-1.12.4.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/oaips.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/public.js"></script>
  </head>
  <body>
    <input type="checkbox" id="menu-ckb" class="_ckbh">
    <input type="checkbox" id="info-ckb" class="_ckbh">
    
    <?php echo $_header;?>
    <?php echo $_menu;?>

    <main id="main"><div>
      
      <div class="album">
        <article class="cover">
          <figure data-bgurl="<?php echo $album->ogImage;?>">
            <img alt="<?php echo ($album->title ? $album->title . ' - ' : '') . TITLE;?>" src="<?php echo $album->ogImage;?>" />
            <figcaption><?php echo ($album->title ? $album->title . ' - ' : '') . TITLE;?></figcaption>
          </figure>
          
          <header>
            <h1><?php echo $album->title;?></h1>
            <span><?php echo str_replace('-', ' ', $album->htmlName());?></span>
          </header>

          <section class="md"><?php echo $album->content;?></section>
          <time datetime="<?php echo $album->updateAt->format('Y-m-d');?>" date="<?php echo $album->updateAt->format('Y.m.d');?>" editdate="editdate"><?php echo $album->updateAt->format('Y-m-d 00:00:00');?></time>
        </article>

        <div id='pics'><?php echo implode('', array_map(function($image) use ($album) {
          $figureAttrs = [
            'data-bgurl' => $image['src'],
            'class' => $image['class'],
          ];
          $imgAttrs = [
            'alt' => ($image['alt'] ? $item['alt'] . ' - ' : '') . $album->title,
            'src' => $image['src']
          ];

          $return = '';
          $return .= '<figure' . attr($figureAttrs) . '>';
          $return .= '<img' . attr($imgAttrs) . '>';
          $return .= '<figcaption>' . ($image['alt'] ? $item['alt'] : $album->title) . '</figcaption>';
          $return .= '</figure>';

          return $return;
        }, $album->images));?></div>
      </div>

    </div></main>

    <?php echo $_info;?>

    <div id="fb-root"></div>
  </body>
</html>