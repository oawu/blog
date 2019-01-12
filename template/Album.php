<!DOCTYPE html>
<html lang="zh-Hant">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">
    <meta name="google-site-verification" content="oP5AjoCz_SS0W6OeLiynUxpE7hnFdhWVZ6zDxRiJQqY" />

    <meta name="robots" content="index,follow" />
    <meta name="keywords" content="<?php echo KEYWORDS;?>" />
    <meta name="description" content="<?php echo mb_strimwidth(str_replace('"', "'", $article->description), 0, 120, '…','UTF-8');?>" />

    <meta property="og:url" content="<?php echo $article->url();?>" />
    <meta property="og:title" content="<?php echo ($article->title ? $article->title . SEPARATE : '') . TITLE;?>" />
    <meta property="og:description" content="<?php echo mb_strimwidth(str_replace('"', "'", $article->description), 0, 200, '…','UTF-8');?>" />

    <meta property="og:site_name" content="<?php echo TITLE;?>" />
    <meta property="fb:admins" content="100000100541088" />
    <meta property="fb:app_id" content="1033322433418965" />
    <meta property="og:locale" content="zh_TW" />
    <meta property="og:locale:alternate" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="article:author" content="https://www.facebook.com/comdan66" />
    <meta property="article:publisher" content="https://www.facebook.com/comdan66" />

    <meta property="article:published_time" content="<?php echo $article->createAt->format('c');?>" />
    <meta property="article:modified_time" content="<?php echo $article->updateAt->format('c');?>" />

    <meta property="og:image" tag="larger" content="<?php echo $article->ogImage;?>" alt="<?php echo TITLE;?>" />
    <meta property="og:image:type" tag="larger" content="<?php echo typeOfImg($article->ogImage);?>" />
    <meta property="og:image:width" tag="larger" content="1200" />
    <meta property="og:image:height" tag="larger" content="630" />

    <title><?php echo ($article->title ? $article->title . SEPARATE : '') . TITLE;?></title>

    <link rel="canonical" href="<?php echo $article->url();?>" />
    <link rel="alternate" href="<?php echo $article->url();?>" hreflang="zh-Hant" />

    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/oaips.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/public.css">

    <script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/jquery-1.12.4.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/oaips.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/public.js"></script>
    <?php echo jsonLd([
      '@context' => 'http://schema.org', 
      '@type' => 'Article',
      'url' => $article->url(),
      'headline' => $article->title,
      'image' => $article->ogImage,
      'datePublished' => $article->createAt->format('c'),
      'dateModified' => $article->updateAt->format('c'),
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
      'description' => $article->description,
      'dateCreated' => $article->createAt->format('c'),
      'dateModified' => $article->updateAt->format('c'),
      'alternativeHeadline' => TITLE,
      'keywords' => implode(' ', $article->tags), 
      'genre' => $article->items() ? $article->items()->text() : TITLE, 
      'articleBody' => removeHtmlTag($article->content),
      'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => $article->url()]], [
      '@context' => 'http://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => $scopes = array_values(array_filter([
        ['@type' => 'ListItem', 'position' => 1, 'item' => ['@id' => BASE_URL, 'name' => TITLE, 'url' => BASE_URL] ],
        $article->items() ? ['@type' => 'ListItem', 'position' => 2, 'item' => ['@id' => $article->items()->url(), 'name' => $article->items()->text(), 'url' => $article->items()->url()] ] : null,
        ['@type' => 'ListItem', 'position' => $article->items() ? 3 : 2, 'item' => ['@id' => $article->url(), 'name' => $article->title, 'url' => $article->url()] ]
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
          <figure data-bgurl="<?php echo $article->ogImage;?>">
            <img alt="<?php echo ($article->title ? $article->title . SEPARATE : '') . TITLE;?>" src="<?php echo $article->ogImage;?>" />
            <figcaption><?php echo ($article->title ? $article->title . SEPARATE : '') . TITLE;?></figcaption>
          </figure>
          
          <header>
            <h1><?php echo $article->title;?></h1>
            <span><?php echo str_replace('-', ' ', $article->fileName());?></span>
          </header>

          <section class="md"><?php echo $article->content;?></section>
          <time datetime="<?php echo $article->updateAt->format('Y-m-d 00:00:00');?>" date="<?php echo $article->updateAt->format('Y.m.d');?>" editdate="editdate"><?php echo $article->updateAt->format('Y-m-d 00:00:00');?></time>
        </article>

        <div id="pics"><?php echo implode('', array_map(function($image) use ($article) {
          $figureAttrs = [
            'data-bgurl' => $image['src'],
            'class' => $image['class'],
          ];
          $imgAttrs = [
            'alt' => ($image['alt'] ? $item['alt'] . SEPARATE : '') . $article->title,
            'src' => $image['src']
          ];

          $return = '';
          $return .= '<figure' . attr($figureAttrs) . '>';
          $return .= '<img' . attr($imgAttrs) . '>';
          $return .= '<figcaption>' . ($image['alt'] ? $item['alt'] : $article->title) . '</figcaption>';
          $return .= '</figure>';

          return $return;
        }, $article->images));?></div>
      </div>

    </div></main>

    <?php echo $_info;?>

    <?php echo scope($scopes);?>
    <div id="fb-root"></div>
  </body>
</html>