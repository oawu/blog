<div id="menu" data-bc="menu-ckb">
  <header>
    <div>OA's</div>
    <div>生活部落格</div>
  </header>

  <?php
  echo implode('', Menu::links(isset($currentUrl) ? $currentUrl : null));
  ?>

  <footer>
    <a href="<?php echo License::url();?>">服務條款 - 授權聲明</a>
    <span>©2014 - <?php echo date('Y');?> WWW.IOA.TW</span>
  </footer>
</div>