<?php



  if (!function_exists ('md')) {
    function md ($source_dir) {
      if ($fp = @opendir ($source_dir)) {
        while (FALSE !== ($file = readdir ($fp))) {
          if (!trim ($file, '.') OR ($hidden == FALSE && $file[0] == '.'))
            continue;
          if (is_file($source_dir . DIRECTORY_SEPARATOR . $file) && pathinfo ($source_dir . DIRECTORY_SEPARATOR . $file, PATHINFO_EXTENSION) == 'md')
            return $file;
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
  if (!function_exists ('write_file')) {
    function write_file ($path, $data, $mode = FOPEN_WRITE_CREATE_DESTRUCTIVE) {

      if (!($fp = @fopen ($path, $mode)))
        return FALSE;
      flock ($fp, LOCK_EX);
      fwrite ($fp, $data);
      flock ($fp, LOCK_UN);
      fclose ($fp);
      return TRUE;
    }
  }

  require_once './lib/Michelf/Markdown.inc.php';

  foreach ($folders = mds () as $folder) {
    $text = file_get_contents ($folder['path'] . DIRECTORY_SEPARATOR . $folder['date'] . DIRECTORY_SEPARATOR . $folder['name']);
    $html = Markdown::defaultTransform ($text);
  }
  $a = write_file ('articles/111.qqq', 'aswwwwd', 'w+');



