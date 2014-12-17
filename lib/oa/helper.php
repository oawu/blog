<?php
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
if (!function_exists ('md')) {
  function md ($source_dir) {
    global $_format;

    if ($fp = @opendir ($source_dir)) {
      while (FALSE !== ($file = readdir ($fp))) {
        if (!trim ($file, '.') OR ($hidden == FALSE && $file[0] == '.'))
          continue;

        if (is_file($source_dir . DIRECTORY_SEPARATOR . $file) && ('.' . pathinfo ($source_dir . DIRECTORY_SEPARATOR . $file, PATHINFO_EXTENSION)) == $_format)
          return str_replace ($_format, '', $file);
      }
    }
    return null;
  }
}
if (!function_exists ('mds')) {
  function mds () {
    global $_mds, $_format;

    $folders = array ();
    if ($fp = @opendir ($_mds)) {
      while (FALSE !== ($file = readdir ($fp))) {
        if (!trim ($file, '.') OR ($hidden == FALSE && $file[0] == '.'))
          continue;
        if (@is_dir ($_mds . DIRECTORY_SEPARATOR . $file) && ($name = md ($_mds . DIRECTORY_SEPARATOR . $file, $_format))) {
          array_push ($folders, array ('path' => $_mds, 'date' => $file, 'name' => $name, 'content' => read_file ($_mds . DIRECTORY_SEPARATOR . $file . DIRECTORY_SEPARATOR . $name . $_format)));
        }
      }
      closedir ($fp);
    }
    return $folders;
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

if (!function_exists ('load_view')) {
  function load_view ($_oa_path = '', $data = array ()) {
    if (!$_oa_path) return '';

    extract ($data);
    ob_start ();

    if (((bool)@ini_get ('short_open_tag') === FALSE) && (config_item ('rewrite_short_tags') == TRUE)) echo eval ('?>'.preg_replace ("/;*\s*\?>/", "; ?>", str_replace ('<?=', '<?php echo ', file_get_contents ($_oa_path))));
    else include $_oa_path;

    $buffer = ob_get_contents ();
    @ob_end_clean ();

    return $buffer;
  }
}

if (!function_exists ('blocks')) {
  function blocks ($name, $blocks, $page_count) {
    global $_oput_format, $_model, $_pagination_limit, $_is_show_next, $_is_show_prev, $_pagination_limit;
    $lis = array ();

    if ($_is_show_next && $name) array_push ($lis, array ('href' => ($name - 1) . $_oput_format, 'content' => '上一頁', 'active' => false));
    for ($i = (!$_pagination_limit || (($name - $_pagination_limit) < 0)) ? 0 : ($name - $_pagination_limit); ($i < $page_count) && (!$_pagination_limit || ($i < ($name + $_pagination_limit + 1))); $i++) array_push ($lis, array ('href' => $i . $_oput_format, 'content' => $i + 1, 'active' => $name == $i));
    if ($_is_show_prev && (($name + 1) != $page_count)) array_push ($lis, array ('href' => ($name + 1) . $_oput_format, 'content' => '下一頁', 'active' => false));

    return write_file ('list' . DIRECTORY_SEPARATOR . $name . $_oput_format, load_view ($_model['list']['view'], array ('blocks' => $blocks, 'lis' => $lis)), 'w+');
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
