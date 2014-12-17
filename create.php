<?php

  include_once './config/path.php';
  include_once './config/setting.php';

  include_once './lib/oa/helper.php';
  require_once './lib/Michelf/Markdown.inc.php';
  
  $folders = array_filter (mds (), function ($t) { return $t['content']; });

  $total = count ($folders);
  $page_count = ceil ($total / $_a_page_limit);
  $blocks = array ();

  directory_delete ($_article . DIRECTORY_SEPARATOR);
  directory_delete ($_list . DIRECTORY_SEPARATOR);

  foreach ($folders as $i => $folder) {
    write_file ($_list . DIRECTORY_SEPARATOR . 'index' . $_oput_format, load_view ($_model['list']['index']), 'w+');

    if ($_format == '.md')
      $html = Markdown::defaultTransform ($folder['content']);
    else 
      $html = '';

    array_push ($blocks, array ('name' => $folder['name'], 'date' => $folder['date'], 'content' => mb_strimwidth (preg_replace('/\n*/m', '', strip_tags ($html)), 0, 100, '…', 'UTF-8'), 'href' => '../' . $_article . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . $folder['name'] . $_oput_format));

    !(($i + 1) % $_a_page_limit) && blocks (floor ($i / $_a_page_limit), $blocks, $page_count) && $blocks = array ();
    
    $p = $_article . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR;
    $n = $folder['name'] . $_oput_format;

    $o = umask (0);
    @mkdir ($p, 0777, true);
    umask ($o);

    write_file ($p . $n, load_view ($_model['article']['view'], array ('name' => $folder['name'], 'date' => $folder['date'], 'content' => $html)), 'w+');
  }
  
  $blocks && blocks (floor ($i / $_a_page_limit), $blocks, $page_count);



