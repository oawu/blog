<?php

  include_once './config/path.php';
  include_once './config/setting.php';
  include_once './config/owner.php';
  include_once './config/footer.php';
  include_once './lib/oa/helper.php';
  require_once $_format == '.md' ? './lib/Michelf/Markdown.inc.php' : './lib/phpQuery/phpQuery.php';

  $folders = array_filter (mds (), function ($t) { return $t['content']; });
  usort ($folders, function ($a, $b) { return ($a['date'] > $b['date']) ? -1 : 1; });

  $total      = count ($folders);
  $page_count = ceil ($total / $_a_page_limit);
  $blocks     = array ();

  foreach (array ($_article, $_list, $_tags) as $n)
    if (!file_exists ($n . DIRECTORY_SEPARATOR)) {
      $o = umask (0);
      @mkdir ($n . DIRECTORY_SEPARATOR, 0777, true);
      umask ($o);
    }

  directory_delete ($_article . DIRECTORY_SEPARATOR);
  directory_delete ($_list . DIRECTORY_SEPARATOR);

  $tags = array ();
  $tree = array ();
  foreach ($folders as $i => $folder) {
    foreach ($folder['tags'] as $tag)
      if (isset ($tags[$tag])) array_push ($tags[$tag], $folder);
      else $tags[$tag] = array ($folder);

    $year = preg_replace ('#(\d{4})-(\d{1,2})-(\d{1,2})(_(\d{1,2})-(\d{1,2})-(\d{1,2}))?#', '$1', $folder['date']);
    $month = preg_replace ('#(\d{4})-(\d{1,2})-(\d{1,2})(_(\d{1,2})-(\d{1,2})-(\d{1,2}))?#', '$2', $folder['date']);

    if (!isset ($tree[$year])) $tree[$year] = array ('count' => 1, 'months' => array ());
    else $tree[$year]['count']++;
    if (!isset ($tree[$year]['months'][$month])) $tree[$year]['months'][$month] = array ('count' => 1, 'blogs' => array ());
    else $tree[$year]['months'][$month]['count']++;
    $tree[$year]['months'][$month]['blogs'][$_article . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . $folder['name'] . $_oput_format] = $folder['name'];
  }

  if ($folders) {
    foreach ($folders as $i => $folder) {
      $folder['content'] = $_format == '.md' ? preg_replace ('#(!\[.*?\]\()\s?((?!https?:\/\/).*)(\))#', '$1../../' . $_mds . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . '$2$3', $folder['content']) : preg_replace ('#src=(["\'])((?!https?:\/\/).*)(["\'])#', 'src=$1../../' . $_mds . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . '$2$3', $folder['content']);
      $html = $_format == '.md' ? Markdown::defaultTransform ($folder['content']) : pq ("body", phpQuery::newDocument ($folder['content']))->html ();

      array_push ($blocks, array (
        'name' => $folder['name'],
        'date' => preg_replace ('#(\d{4})-(\d{1,2})-(\d{1,2})_(\d{1,2})-(\d{1,2})-(\d{1,2})#', '$1-$2-$3 $4:$5:$6', $folder['date']),
        'content' => mb_strimwidth (preg_replace ('/\n*/m', '', strip_tags ($html)), 0, $_list_preview_length, '…', 'UTF-8'),
        'href' => '../' . $_article . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . $folder['name'] . $_oput_format,
        'tags' => $folder['tags'],
        'tag_base_url' => $_tags . DIRECTORY_SEPARATOR
        ));

      !(($i + 1) % $_a_page_limit) && list_blocks (floor ($i / $_a_page_limit), $blocks, $page_count, $tags, $tree) && $blocks = array ();

      $p = $_article . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR;
      $n = $folder['name'] . $_oput_format;

      $o = umask (0);
      @mkdir ($p, 0777, true);
      umask ($o);

      write_file ($p . $n,
        load_view ($_template['article']['view'], array (
          'name' => $folder['name'],
          'date' => preg_replace ('#(\d{4})-(\d{2})-(\d{2})_(\d{2})-(\d{2})-(\d{2})#', '$1-$2-$3 $4:$5:$6', $folder['date']),
          'content' => $html,
          'tags' => $tags,
          'tree' => $tree)), 'w+');
    }

    $blocks && list_blocks (floor ($i / $_a_page_limit), $blocks, $page_count, $tags, $tree) && write_file ($_list . DIRECTORY_SEPARATOR . 'index' . $_oput_format, load_view ($_template['list']['index']), 'w+');

    directory_delete ($_tags . DIRECTORY_SEPARATOR);
    foreach ($tags as $tag => $folders) {
      $total = count ($folders);
      $page_count = ceil ($total / $_a_page_limit);
      $blocks = array ();

      foreach ($folders as $i => $folder) {

        array_push ($blocks, array (
          'name' => $folder['name'],
          'date' => preg_replace ('#(\d{4})-(\d{1,2})-(\d{1,2})_(\d{1,2})-(\d{1,2})-(\d{1,2})#', '$1-$2-$3 $4:$5:$6', $folder['date']),
          'content' => mb_strimwidth (preg_replace ('/\n*/m', '', strip_tags ($html)), 0, $_list_preview_length, '…', 'UTF-8'),
          'href' => '../' . $_article . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . $folder['name'] . $_oput_format,
          'tags' => $folder['tags'],
          'tag_base_url' => $_tags . DIRECTORY_SEPARATOR
          ));

        !(($i + 1) % $_a_page_limit) && tags_blocks (floor ($i / $_a_page_limit), $blocks, $page_count, $tag, $tags, $tree) && $blocks = array ();
      }
      $blocks && tags_blocks (floor ($i / $_a_page_limit), $blocks, $page_count, $tag, $tags, $tree) && write_file ($_tags . DIRECTORY_SEPARATOR . $tag . DIRECTORY_SEPARATOR . 'index' . $_oput_format, load_view ($_template['tags']['index']), 'w+');
    }

    write_file ('./index' . $_oput_format, load_view ($_template['main']['index']), 'w+');
  } else {
    write_file ($_list . DIRECTORY_SEPARATOR . 0 . $_oput_format, load_view ($_template['list']['view'], array ('blocks' => array (), 'lis' => array (), 'tags' => array (), 'tree' => array ())), 'w+');
    write_file ($_list . DIRECTORY_SEPARATOR . 'index' . $_oput_format, load_view ($_template['list']['index']), 'w+');
  }