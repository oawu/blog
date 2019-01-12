<!DOCTYPE html>
<html lang="zh-Hant">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">
    <meta name="google-site-verification" content="oP5AjoCz_SS0W6OeLiynUxpE7hnFdhWVZ6zDxRiJQqY" />

    <meta name="robots" content="index,follow" />
    <meta name="keywords" content="<?php echo implode(', ', array_unique(arrayFlatten(array_map(function($item) { return $item->tags; }, $page->items()))));?>" />
    <meta name="description" content="<?php echo mb_strimwidth(removeHtmlTag(str_replace('"', "'", DESCRIPTION)), 0, 120, '…','UTF-8');?>" />

    <meta property="og:url" content="<?php echo $page->url();?>" />
    <meta property="og:title" content="<?php echo $articles->text() . SEPARATE . TITLE;?>" />
    <meta property="og:description" content="<?php echo mb_strimwidth(removeHtmlTag(str_replace('"', "'", DESCRIPTION)), 0, 200, '…','UTF-8');?>" />

    <meta property="og:site_name" content="<?php echo TITLE;?>" />
    <meta property="fb:admins" content="100000100541088" />
    <meta property="fb:app_id" content="1033322433418965" />
    <meta property="og:locale" content="zh_TW" />
    <meta property="og:locale:alternate" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="article:author" content="https://www.facebook.com/comdan66" />
    <meta property="article:publisher" content="https://www.facebook.com/comdan66" />

    <meta property="article:published_time" content="<?php echo date('c');?>" />
    <meta property="article:modified_time" content="<?php echo date('c');?>" />

    <meta property="og:image" tag="larger" content="<?php echo OG_IMG_URL;?>" alt="<?php echo TITLE;?>" />
    <meta property="og:image:type" tag="larger" content="<?php echo typeOfImg(OG_IMG_URL);?>" />
    <meta property="og:image:width" tag="larger" content="1200" />
    <meta property="og:image:height" tag="larger" content="630" />

    <title><?php echo $articles->text() . SEPARATE . TITLE;?></title>
    
    <link rel="canonical" href="<?php echo $page->url();?>" />
    <link rel="alternate" href="<?php echo $page->url();?>" hreflang="zh-Hant" />

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
      ];}, $page->items(), array_keys($page->items()))], [
      '@context' => 'http://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => $scopes = array_values(array_filter([
        ['@type' => 'ListItem', 'position' => 1, 'item' => ['@id' => BASE_URL, 'name' => TITLE, 'url' => BASE_URL] ],
        ['@type' => 'ListItem', 'position' => 2, 'item' => ['@id' => $page->url(), 'name' => $articles->text(), 'url' => $page->url()] ]
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
          'alt' => ($item->title ? $item->title . SEPARATE : '') . TITLE,
          'src' => $item->iconImage
        ];
        $bAttrs = [
          'data-id' => $item->id ? (int)$item->id : null,
        ];

        $return = '';
        $return .= '<a' . attr($aAttrs) . '>';
          $return .= '<figure' . attr($figureAttrs) . '>';
            $return .= '<img' . attr($imgAttrs) . '/>';
            $return .= '<figcaption>' . $item->title . '</figcaption>';
          $return .= '</figure>';
          $return .= '<b' . attr($bAttrs) . '>' . $item->title . '</b>';
          $return .= '<div>' . implode('', array_map(function($t) { return '<span>' . $t . '</span>'; }, $item->tags)) . '</div>';
          $return .= '<section>' . $item->description . '</section>';
          $return .= '<time datetime="' . $item->createAt->format('Y-m-d 00:00:00') . '" date="' . $item->createAt->format('Y.m.d') . '" pubdate="pubdate">' . $item->createAt->format('Y.m.d') . '</time>';

        $return .= '</a>';
        return $return;
      }, $page->items()));?></div>
      <div class="page"><span><?php echo $page->pagination();?></span></div>
    </div></main>

    <?php echo $_info;?>

    <?php echo scope($scopes);?>
    <div id="fb-root"></div>
  </body>
</html>