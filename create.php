<?php
  if (!function_exists ('md')) {
    function md ($source_dir) {
      if ($fp = @opendir ($source_dir)) {
        while (FALSE !== ($file = readdir ($fp))) {
          if (!trim ($file, '.') OR ($hidden == FALSE && $file[0] == '.'))
            continue;
          if (is_file($source_dir . DIRECTORY_SEPARATOR . $file) && pathinfo ($source_dir . DIRECTORY_SEPARATOR . $file, PATHINFO_EXTENSION) == 'md')
            return str_replace ('.md', '', $file);
        }
      }
    }
  }
  if (!function_exists ('mds')) {
    function mds () {
      $source_dir = 'mds';
      $folders = array ();
      if ($fp = @opendir ($source_dir)) {
        while (FALSE !== ($file = readdir ($fp))) {
          if (!trim ($file, '.') OR ($hidden == FALSE && $file[0] == '.'))
            continue;
          if (@is_dir ($source_dir . DIRECTORY_SEPARATOR . $file))
            array_push ($folders, array ('path' => $source_dir, 'date' => $file, 'name' => md ($source_dir . DIRECTORY_SEPARATOR . $file)));
        }
        closedir ($fp);
      }
      return $folders;
    }
  }

  if (!function_exists ('read_file')) {
    function read_file ($file) {
      if (!file_exists ($file))
        return FALSE;

      if (function_exists ('file_get_contents'))
        return file_get_contents($file);

      if (!$fp = @fopen ($file, FOPEN_READ))
        return FALSE;

      flock ($fp, LOCK_SH);

      $data = '';
      if (filesize ($file) > 0) $data =& fread ($fp, filesize ($file));

      flock ($fp, LOCK_UN);
      fclose ($fp);
      return $data;
    }
  }
  if (!function_exists ('write_file')) {
    function write_file ($path, $data, $mode = FOPEN_WRITE_CREATE_DESTRUCTIVE) {
      if (!($fp = @fopen ($path, $mode))) return FALSE;
      flock ($fp, LOCK_EX);
      fwrite ($fp, $data);
      flock ($fp, LOCK_UN);
      fclose ($fp);
      return TRUE;
    }
  }

  if (!function_exists ('blocks')) {
    function blocks ($name, $blocks, $model_list, $model_list_pagination, $page_count) {
      $pagination = array ();
      
      if ($name) array_push ($pagination, '<li><a href="' . ($name - 1) . '.html">上一頁</a></li>');
      for ($i = 0; $i < $page_count; $i++) array_push ($pagination, '<li' . ($name == $i ? ' class="active"' : '') . '><a href="' . $i . '.html">' . ($i + 1) . '</a></li>');
      if (($name + 1) != $page_count) array_push ($pagination, '<li><a href="' . ($name + 1) . '.html">下一頁</a></li>');
      write_file ('list' . DIRECTORY_SEPARATOR . $name . '.html', sprintf ($model_list, implode ('', $blocks), sprintf ($model_list_pagination, implode ('', $pagination))), 'w+');
    }
  }

if (!function_exists ('directory_delete')) {
  function directory_delete ($dir, $is_root = false) {
    $dir = rtrim ($dir, DIRECTORY_SEPARATOR);

    if (!($current_dir = @opendir ($dir)))
      return FALSE;

    while (FALSE !== ($filename = @readdir ($current_dir))) {
      if ($filename != "." and $filename != "..") {
        if (is_dir ($dir . DIRECTORY_SEPARATOR . $filename)) {
          if (substr ($filename, 0, 1) != '.') {
            directory_delete ($dir . DIRECTORY_SEPARATOR . $filename);
            rmdir  ($dir . DIRECTORY_SEPARATOR . $filename);
          }
        } else {
          unlink ($dir . DIRECTORY_SEPARATOR . $filename);
        }
      }
    }
    @closedir ($current_dir);

    return $is_root ? @rmdir($dir) : false;
  }
}
  require_once './lib/Michelf/Markdown.inc.php';
  
  $folders = mds ();
  $total = count ($folders);
  $count_page = 4;
  $blocks = array ();

  $model_list_index = read_file ('models' . DIRECTORY_SEPARATOR . 'list_index.html');
  $model_list       = read_file ('models' . DIRECTORY_SEPARATOR . 'list.html');
  $model_list_block = read_file ('models' . DIRECTORY_SEPARATOR . 'list_block.html');
  $model_list_pagination = read_file ('models' . DIRECTORY_SEPARATOR . 'pagination.html');

  $model_article = read_file ('models' . DIRECTORY_SEPARATOR . 'article.html');
  $model_article_block = read_file ('models' . DIRECTORY_SEPARATOR . 'article_block.html');
  
  directory_delete ('article' . DIRECTORY_SEPARATOR);
  directory_delete ('list' . DIRECTORY_SEPARATOR);

  foreach ($folders as $i => $folder) {
      write_file ('list' . DIRECTORY_SEPARATOR . 'index.html', $model_list_index, 'w+');
      
    $html = Markdown::defaultTransform (read_file ($folder['path'] . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . $folder['name'] . '.md'));

    array_push ($blocks, sprintf ($model_list_block, $folder['name'], $folder['date'], mb_strimwidth (preg_replace('/\n*/m', '', strip_tags ($html)), 0, 100, '…', 'UTF-8'), '<a href="..' . DIRECTORY_SEPARATOR . 'article' . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . $folder['name'] . '.html' . '">閱讀更多 »</a>'));

    if (!(($i + 1) % $count_page)) {
      blocks (floor ($i/$count_page), $blocks, $model_list, $model_list_pagination, ceil ($total/$count_page));
      $blocks = array ();
    }
    $p = 'article' . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR;
    $n = $folder['name'] . '.html';
    
    $o = umask (0);
    @mkdir ($p, 0777, true);
    umask ($o);

    write_file ($p . $n, sprintf ($model_article, sprintf ($model_article_block, $folder['name'], $folder['date'], $html)), 'w+');
  }
  if ($blocks)
    blocks (floor ($i/$count_page), $blocks, $model_list, $model_list_pagination, ceil ($total/$count_page));



