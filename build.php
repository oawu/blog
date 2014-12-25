<?php
  date_default_timezone_set('Asia/Taipei');

  include_once './config/system.php';
  include_once './config/setting.php';
  include_once './config/owner.php';
  include_once './config/seo.php';

  include_once './lib/oa/helper.php';
  require_once $_format == '.md' ? './lib/Michelf/Markdown.inc.php' : './lib/phpQuery/phpQuery.php';
  include_once './lib/Sitemap/Sitemap.php';

  $folders = array_filter (mds (), function ($t) { return $t['content'] && !preg_replace ('#(\d{4})-(\d{1,2})-(\d{1,2})_(\d{1,2})-(\d{1,2})-(\d{1,2})#', '', $t['date']); });
  usort ($folders, function ($a, $b) { return ($a['date'] > $b['date']) ? -1 : 1; });

  $total      = count ($folders);
  $page_count = ceil ($total / $_a_page_limit);

  foreach (array ($_article, $_list, $_tags, $_sitemap) as $n)
    if (!file_exists ($n . DIRECTORY_SEPARATOR)) {
      $o = umask (0);
      @mkdir ($n . DIRECTORY_SEPARATOR, 0777, true);
      umask ($o);
    } else {
      directory_delete ($n . DIRECTORY_SEPARATOR);
    }

  $blocks = $tags = $tree = $temp = array ();
  foreach ($folders as $i => $folder) {
    if (array_push ($temp, $folder['file_name']) && ($count = count (array_filter ($temp, function ($t) use ($folder) { return $t == $folder['file_name']; })) - 1))
      $folders[$i]['file_name'] = $folder['file_name'] = $folder['file_name'] . '(' . ($count + 1) . ')';

    foreach ($folder['tags'] as $tag)
      if (isset ($tags[strtolower ($tag)])) array_push ($tags[strtolower ($tag)], $folder);
      else $tags[strtolower ($tag)] = array ($folder);

    $year = preg_replace ('#(\d{4})-(\d{1,2})-(\d{1,2})_(\d{1,2})-(\d{1,2})-(\d{1,2})#', '$1', $folder['date']);
    $month = preg_replace ('#(\d{4})-(\d{1,2})-(\d{1,2})_(\d{1,2})-(\d{1,2})-(\d{1,2})#', '$2', $folder['date']);

    if (!isset ($tree[$year])) $tree[$year] = array ('count' => 1, 'months' => array ());
    else $tree[$year]['count']++;
    if (!isset ($tree[$year]['months'][$month])) $tree[$year]['months'][$month] = array ('count' => 1, 'blogs' => array ());
    else $tree[$year]['months'][$month]['count']++;
    $tree[$year]['months'][$month]['blogs'][preg_replace ('#(^\.\/)#', '', $_article) . '/' . $folder['file_name'] . $_oput_format] = $folder['name'];
  }
  unset ($temp);
  uasort ($tags, function ($a, $b) { return (count ($a) > count ($b)) ? -1 : 1; });

  if ($folders) {
    $sit_map = new Sitemap ($_domain);
    $sit_map->setPath ($_sitemap . DIRECTORY_SEPARATOR);
    $sit_map->setDomain ($_domain);
    foreach ($folders as $i => $folder) {
      $folder['content'] = $_format == '.md' ? preg_replace ('#(!\[.*?\]\()\s?((?!https?:\/\/).*)(\))#', '$1../' . $_mds . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . '$2$3', $folder['content']) : preg_replace ('#src=(["\'])((?!https?:\/\/).*)(["\'])#', 'src=$1../' . $_mds . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . '$2$3', $folder['content']);
      $html = $_format == '.md' ? Markdown::defaultTransform ($folder['content']) : pq ("body", phpQuery::newDocument ($folder['content']))->html ();

      array_push ($blocks, array (
        'name' => $folder['file_name'],
        'date' => preg_replace ('#(\d{4})-(\d{1,2})-(\d{1,2})_(\d{1,2})-(\d{1,2})-(\d{1,2})#', '$1-$2-$3 $4:$5:$6', $folder['date']),
        'content' => mb_strimwidth (preg_replace ('/\n*/m', '', strip_tags ($html)), 0, $_list_preview_length, '…', 'UTF-8'),
        'href' => '../' . preg_replace ('#(^\.\/)#', '', $_article) . '/' . rawurlencode ($folder['file_name']) . $_oput_format,
        'tags' => $folder['tags']
        ));

      !(($i + 1) % $_a_page_limit) && list_blocks (floor ($i / $_a_page_limit), $blocks, $page_count, $tags, $tree) && $blocks = array ();

      $sit_map->addItem ($_git_name . '/' . preg_replace ('#(^\.\/)#', '', $_article) . '/' . rawurlencode ($folder['file_name']) . $_oput_format, '0.8', 'daily', preg_replace ('#(\d{4})-(\d{1,2})-(\d{1,2})_(\d{1,2})-(\d{1,2})-(\d{1,2})#', '$1-$2-$3 $4:$5:$6', $folder['date']));
      write_file ($_article . DIRECTORY_SEPARATOR . $folder['file_name'] . $_oput_format,
        load_view ($_template['article']['view'], array (
          'name' => $folder['file_name'],
          'date' => preg_replace ('#(\d{4})-(\d{1,2})-(\d{1,2})_(\d{1,2})-(\d{1,2})-(\d{1,2})#', '$1-$2-$3 $4:$5:$6', $folder['date']),
          'content' => $html,
          'my_url' => $_url . '/' . preg_replace ('#(^\.\/)#', '', $_article) . '/' . $folder['file_name'] . $_oput_format,
          'tag_list' => $folder['tags'],
          'tags' => $tags,
          'tree' => $tree)), 'w+');
    }

    $blocks && list_blocks (floor ($i / $_a_page_limit), $blocks, $page_count, $tags, $tree);
    write_file ($_list . DIRECTORY_SEPARATOR . 'index' . $_oput_format, load_view ($_template['list']['index']), 'w+');

    directory_delete ($_tags . DIRECTORY_SEPARATOR);
    foreach ($tags as $tag => $folders) {
      $total = count ($folders);
      $page_count = ceil ($total / $_a_page_limit);
      $blocks = array ();

      foreach ($folders as $i => $folder) {
        array_push ($blocks, array (
          'name' => $folder['file_name'],
          'date' => preg_replace ('#(\d{4})-(\d{1,2})-(\d{1,2})_(\d{1,2})-(\d{1,2})-(\d{1,2})#', '$1-$2-$3 $4:$5:$6', $folder['date']),
          'content' => mb_strimwidth (preg_replace ('/\n*/m', '', strip_tags ($html)), 0, $_list_preview_length, '…', 'UTF-8'),
          'href' => '../../' . preg_replace ('#(^\.\/)#', '', $_article) . '/' . rawurlencode ($folder['file_name'] ). $_oput_format,
          'tags' => $folder['tags'],
          'tag_base_url' => $_tags . DIRECTORY_SEPARATOR
          ));

        !(($i + 1) % $_a_page_limit) && tags_blocks (floor ($i / $_a_page_limit), $blocks, $page_count, $tag, $tags, $tree) && $blocks = array ();
      }
      $blocks && tags_blocks (floor ($i / $_a_page_limit), $blocks, $page_count, $tag, $tags, $tree);
      write_file ($_tags . DIRECTORY_SEPARATOR . $tag . DIRECTORY_SEPARATOR . 'index' . $_oput_format, load_view ($_template['tags']['index']), 'w+');
    }

    write_file ('./index' . $_oput_format, load_view ($_template['main']['index']), 'w+');
  } else {
    write_file ($_list . DIRECTORY_SEPARATOR . 0 . $_oput_format, load_view ($_template['list']['view'], array ('blocks' => array (), 'lis' => array (), 'tags' => array (), 'tree' => array ())), 'w+');
    write_file ($_list . DIRECTORY_SEPARATOR . 'index' . $_oput_format, load_view ($_template['list']['index']), 'w+');
  }

  $sit_map->createSitemapIndex ($_domain . $_git_name . '/' . preg_replace ('#(^\.\/)#', '', $_sitemap) . '/', 'Today');

  @unlink ('./robots.txt');
  write_file ('./robots.txt', load_view ($_template['seo']['robots'], array ('_sitemap_url' => $_sitemap_url)), 'w+');
