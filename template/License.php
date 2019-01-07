<!DOCTYPE html>
<html lang="zh-Hant">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">

    <title><?php echo ($article->title ? $article->title . ' - ' : '') . TITLE;?></title>

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
        '@id' => $article->url()]]); ?>
    <?php echo jsonLd([
      '@context' => 'http://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => array_values(array_filter([
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

      <article class="panel">

        <header>
          <h1><?php echo $article->title;?></h1>
          <span><?php echo $article->bio;?></span>
        </header>
        
        <section class="md"><?php echo $article->content;?></section>
        <div class="tags"><?php echo implode('', array_map(function($tag) { return '<a href="' . Search::url() . '?q=' . $tag . '">' . $tag . '</a>'; }, $article->tags));?></div>
        <time datetime="<?php echo $article->updateAt->format('Y-m-d 00:00:00');?>" date="<?php echo $article->updateAt->format('Y.m.d');?>" editdate="editdate"><?php echo $article->updateAt->format('Y-m-d 00:00:00');?></time>
      </article>
    
    </div></main>

    <?php echo $_info;?>

    <div id="fb-root"></div>
  </body>
</html>