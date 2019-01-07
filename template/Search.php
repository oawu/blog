<!DOCTYPE html>
<html lang="zh-Hant">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">

    <title><?php echo '搜尋結果' . ' - ' . TITLE;?></title>

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
      ]]); ?>
    <?php echo jsonLd([
      '@context' => 'http://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => array_values(array_filter([
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

    <div id="fb-root"></div>
  </body>
</html>