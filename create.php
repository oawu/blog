<?php

  include_once './config/path.php';
  include_once './config/setting.php';
  include_once './config/owner.php';
  include_once './lib/oa/helper.php';
  require_once $_format == '.md' ? './lib/Michelf/Markdown.inc.php' : './lib/phpQuery/phpQuery.php';

  $folders = array_filter (mds (), function ($t) { return $t['content']; });
  usort ($folders, function ($a, $b) { return ($a['date'] > $b['date']) ? -1 : 1; });

  $total      = count ($folders);
  $page_count = ceil ($total / $_a_page_limit);
  $blocks     = array ();

  directory_delete ($_article . DIRECTORY_SEPARATOR);
  directory_delete ($_list . DIRECTORY_SEPARATOR);

  foreach ($folders as $i => $folder) {
    write_file ($_list . DIRECTORY_SEPARATOR . 'index' . $_oput_format, load_view ($_template['list']['index']), 'w+');

    $folder['content'] = $_format == '.md' ? preg_replace ('#(!\[.*?\]\()\s?((?!https?:\/\/).*)(\))#', '$1../../' . $_mds . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . '$2$3', $folder['content']) : preg_replace ('#src=(["\'])((?!https?:\/\/).*)(["\'])#', 'src=$1../../' . $_mds . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . '$2$3', $folder['content']);
    $html = $_format == '.md' ? Markdown::defaultTransform ($folder['content']) : pq ("body", phpQuery::newDocument ($folder['content']))->html ();

    array_push ($blocks, array (
      'name' => $folder['name'],
      'date' => preg_replace ('#(\d{4})-(\d{2})-(\d{2})_(\d{2})-(\d{2})-(\d{2})#', '$1-$2-$3 $4:$5:$6', $folder['date']),
      'content' => mb_strimwidth (preg_replace ('/\n*/m', '', strip_tags ($html)), 0, $_list_preview_length, '…', 'UTF-8'),
      'href' => '../' . $_article . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . $folder['name'] . $_oput_format,
      'tags' => $folder['tags']
      ));

    !(($i + 1) % $_a_page_limit) && blocks (floor ($i / $_a_page_limit), $blocks, $page_count) && $blocks = array ();

    $p = $_article . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR;
    $n = $folder['name'] . $_oput_format;

    $o = umask (0);
    @mkdir ($p, 0777, true);
    umask ($o);

    write_file ($p . $n, load_view ($_template['article']['view'], array ('name' => $folder['name'], 'date' => preg_replace ('#(\d{4})-(\d{2})-(\d{2})_(\d{2})-(\d{2})-(\d{2})#', '$1-$2-$3 $4:$5:$6', $folder['date']), 'content' => $html, 'nav_items' => $_nav_items, 'pins' => $_pins)), 'w+');
  }

  $blocks && blocks (floor ($i / $_a_page_limit), $blocks, $page_count);



