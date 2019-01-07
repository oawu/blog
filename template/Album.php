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
    <?php echo jsonLd([
      '@context' => 'http://schema.org', 
      '@type' => 'Article',
      'url' => $album->url(),
      'headline' => $album->title,
      'image' => $album->ogImage,
      'datePublished' => $album->createAt->format('c'),
      'dateModified' => $album->updateAt->format('c'),
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
      'description' => $album->description,
      'dateCreated' => $album->createAt->format('c'),
      'dateModified' => $album->updateAt->format('c'),
      'alternativeHeadline' => TITLE,
      'keywords' => implode(' ', $album->tags), 
      'genre' => $album->items() ? $album->items()->text() : TITLE, 
      'articleBody' => removeHtmlTag($album->content),
      'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => $album->url()]], [
      '@context' => 'http://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => $scopes = array_values(array_filter([
        ['@type' => 'ListItem', 'position' => 1, 'item' => ['@id' => BASE_URL, 'name' => TITLE, 'url' => BASE_URL] ],
        $album->items() ? ['@type' => 'ListItem', 'position' => 2, 'item' => ['@id' => $album->items()->url(), 'name' => $album->items()->text(), 'url' => $album->items()->url()] ] : null,
        ['@type' => 'ListItem', 'position' => $album->items() ? 3 : 2, 'item' => ['@id' => $album->url(), 'name' => $album->title, 'url' => $album->url()] ]
      ]))
    ]); ?>
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
            <span><?php echo str_replace('-', ' ', $album->fileName());?></span>
          </header>

          <section class="md"><?php echo $album->content;?></section>
          <time datetime="<?php echo $album->updateAt->format('Y-m-d 00:00:00');?>" date="<?php echo $album->updateAt->format('Y.m.d');?>" editdate="editdate"><?php echo $album->updateAt->format('Y-m-d 00:00:00');?></time>
        </article>

        <div id="pics"><?php echo implode('', array_map(function($image) use ($album) {
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

    <?php echo scope($scopes);?>
    <div id="fb-root"></div>
  </body>
</html>