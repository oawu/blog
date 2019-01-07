<header id="header">
  <div class="container">
<?php
    if (isset($item) && ($page = $item->page())) { ?>
      <a class="back icon-a" href="<?php echo $page->url();?>"></a>
<?php
    }?>

    <label class="menu icon-0" for="menu-ckb"></label>
    
    <a class="logo" href="<?php echo BASE_URL;?>">
      <b>OA's</b>
      <span>生活部落格</span>
      <span>Blog、Album</span>
    </a>
    
    <form class="search" method="get" action="<?php echo Search::url();?>">
      <input type="text" id="q" name="q" placeholder="搜尋 OA Wu.." value="" pattern=".{1,}" required="" title="搜尋">
      <button type="submit" class="icon-1"></button>
    </form>

    <label class="oa-avatar" for="info-ckb" data-bgurl="https://graph.facebook.com/100000100541088/picture?width=100&height=100"></label>

  </div>
</header>