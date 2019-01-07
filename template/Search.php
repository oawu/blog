<!DOCTYPE html>
<html lang="zh-Hant">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">

    <meta name="google-site-verification" content="oP5AjoCz_SS0W6OeLiynUxpE7hnFdhWVZ6zDxRiJQqY" />

    <meta name="robots" content="index,follow" />
    <meta name="keywords" content="<?php echo KEYWORDS;?>" />
    <meta name="description" content="<?php echo mb_strimwidth(removeHtmlTag(str_replace('"', "'", DESCRIPTION)), 0, 150, '…','UTF-8');?>" />

    <meta property="og:url" content="<?php echo Search::url();?>" />
    <meta property="og:title" content="<?php echo '搜尋結果';?>" />
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

    <title><?php echo '搜尋結果' . ' - ' . TITLE;?></title>

    <link rel="canonical" href="<?php echo Search::url();?>" />
    <link rel="alternate" href="<?php echo Search::url();?>" hreflang="zh-Hant" />

    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/public.css">

    <script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/jquery-1.12.4.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/public.js"></script>
    <?php echo jsonLd([
      '@context' => 'http://schema.org', 
      '@type' => 'WebSite', 
      'url' => BASE_URL, 
      'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => BASE_URL . 'search.html?q={keyword}&referrer=jsonLd_searchbox',
        'query-input' => 'required name=keyword'
      ]], [
      '@context' => 'http://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => $scopes = array_values(array_filter([
        ['@type' => 'ListItem', 'position' => 1, 'item' => ['@id' => BASE_URL, 'name' => TITLE, 'url' => BASE_URL] ],
        ['@type' => 'ListItem', 'position' => 2, 'item' => ['@id' => Search::url(), 'name' => '搜尋結果', 'url' => Search::url()] ],
      ]))
    ]); ?>
  </head>
  <body>
    <input type="checkbox" id="menu-ckb" class="_ckbh">
    <input type="checkbox" id="info-ckb" class="_ckbh">
    
    <?php echo $_header;?>
    <?php echo $_menu;?>

    <main id="main"><div id="search" data-api="<?php echo AllJson::url();?>"></div></main>

    <?php echo $_info;?>

    <?php echo scope($scopes);?>
    <div id="fb-root"></div>
  </body>
</html>