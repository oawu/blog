<!DOCTYPE html>
<html lang="zh-Hant">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">
    <meta name="google-site-verification" content="oP5AjoCz_SS0W6OeLiynUxpE7hnFdhWVZ6zDxRiJQqY" />

    <meta name="robots" content="noindex,nofollow" />

    <title><?php echo '404 Not Found' . SEPARATE . TITLE;?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>css/public.css">

    <script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/jquery-1.12.4.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo BASE_URL;?>js/public.js"></script>
    <script type="text/javascript">
    $(function() {
      var url = "<?php echo BASE_URL . '?f=404';?>";

      if (window.location.pathname.slice(-1) == '/')
        url = "<?php echo BASE_URL;?>" + window.location.pathname.slice(1) + 'index.html';
      else if (window.location.pathname.slice(-16, -11) == 'index')
        url =  "<?php echo BASE_URL . '?f=404';?>";
      else if (window.location.pathname.slice(-5) != '.html')
        url =  "<?php echo BASE_URL . '';?>" + window.location.pathname.slice(1) + '.html';
      else if (window.location.pathname.slice(-5) == '.html')
        url = "<?php echo BASE_URL;?>" + window.location.pathname.slice(1, -5) + '/index.html';
      else
        url =  "<?php echo BASE_URL . '?f=404';?>";
     
     var $q = $('#q'), timer = null;

     $q.focus(function() { clearTimeout(timer); });

     if (url != "<?php echo BASE_URL . '?f=404';?>")
       window.location.replace(url);
     else
       timer = setTimeout(function() { window.location.replace(url); }, 7.5 * 1000); 
    });

    </script>
  </head>
  <body>
    <input type="checkbox" id="menu-ckb" class="_ckbh">
    <input type="checkbox" id="info-ckb" class="_ckbh">
    
    <?php echo $_header;?>
    <?php echo $_menu;?>

    <main id="main"><div>
      <div id="p404">
        <b class="icon-1d"></b>
        <header>
          <h1>404</h1>
          <span>頁面好像不見惹</span>
        </header>
        <p>此頁面似乎消失了..</p>
        <p>建議您回<a href="<?php echo BASE_URL;?>" class="icon-d">首頁</a>，或者<label for="q" class="icon-1">搜尋</label>一下吧！</p>
      </div>
    </div></main>

    <?php echo $_info;?>

    <div id="fb-root"></div>
  </body>
</html>