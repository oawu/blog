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
    <?php echo jsonLd([
      '@context' => 'http://schema.org',
      '@type' => 'ItemList',
      'itemListElement' => array_map(function($item, $i) {
        return [
          '@type' => 'Article',
          'position' => $item->page()->index() * Page::OFFSET + $i + 1,
          'url' => $item->url(),
          'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $item->url()
          ],
          'headline' => $item->title,
          'image' => $item->ogImage,
          'datePublished' => $item->createAt->format('c'),
          'dateModified' => $item->updateAt->format('c'),
          'author' => [
            '@type' => 'Person',
            'name' => '吳政賢(OA Wu)',
            'url' => BASE_URL,
            'image' => [
              '@type' => 'ImageObject',
              'url' => OA_IMG_URL
            ]
          ],
          'publisher' => [  
            '@type' => 'Organization',
            'name' => TITLE,
            'logo' => [  
              '@type' => 'ImageObject',
              'url' => LOGO_IMG_URL,
            ]
          ],
          'description' => $item->description,
      ];}, $page->items(), array_keys($page->items()))]); ?>
    <?php echo jsonLd([
      '@context' => 'http://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => array_values(array_filter([
        ['@type' => 'ListItem', 'position' => 1, 'item' => ['@id' => BASE_URL, 'name' => TITLE, 'url' => BASE_URL] ],
        ['@type' => 'ListItem', 'position' => 2, 'item' => ['@id' => $articles->url(), 'name' => $articles->text(), 'url' => $articles->url()] ]
      ]))
    ]); ?>
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
          $return .= '<time datetime="' . $item->createAt->format('Y-m-d 00:00:00') . '" date="' . $item->createAt->format('Y.m.d') . '" pubdate="pubdate">' . $item->createAt->format('Y.m.d') . '</time>';

        $return .= '</a>';
        return $return;
      }, $page->items()));?></div>
      <div class="page"><span><?php echo $page->pagination();?></span></div>
    </div></main>

    <?php echo $_info;?>

    <div id="fb-root"></div>
  </body>
</html>