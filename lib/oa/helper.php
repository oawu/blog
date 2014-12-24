<?php
/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */

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
        if (!trim ($file, '.') OR ($file[0] == '.'))
          continue;

        if (is_file($source_dir . DIRECTORY_SEPARATOR . $file) && ('.' . pathinfo ($source_dir . DIRECTORY_SEPARATOR . $file, PATHINFO_EXTENSION)) == $_format)
          return str_replace ($_format, '', $file);
      }
    }
    return null;
  }
}
if (!function_exists ('tags')) {
  function tags ($source_dir) {
    if (!($tags = read_file ($source_dir))) return array ();
    return array_filter (preg_split ("#\n#", $tags));
  }
}
if (!function_exists ('mds')) {
  function mds () {
    global $_mds, $_format, $_tags_file_name;

    $folders = array ();
    if ($fp = @opendir ($_mds)) {
      while (FALSE !== ($file = readdir ($fp))) {
        if (!trim ($file, '.') OR ($file[0] == '.'))
          continue;
        if (@is_dir ($_mds . DIRECTORY_SEPARATOR . $file) && ($name = md ($_mds . DIRECTORY_SEPARATOR . $file))) {
          array_push ($folders, array (
            'path' => $_mds,
            'date' => $file,
            'name' => $name,
            'file_name' => $name,
            'content' => read_file ($_mds . DIRECTORY_SEPARATOR . $file . DIRECTORY_SEPARATOR . $name . $_format),
            'tags' => tags ($_mds . DIRECTORY_SEPARATOR . $file . DIRECTORY_SEPARATOR . $_tags_file_name)
            ));
        }
      }
      closedir ($fp);
    }
    return $folders;
  }
}

if (!function_exists ('write_file')) {
  function write_file ($path, $data, $mode = 0777) {
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
    global $_navbar_mobile, $_footer, $_list_more, $_mobile_right_slides, $_nav_items, $_pins, $_tags, $_list, $_title, $_url, $_author, $_keywords, $_description, $_og;
    ob_start ();

    if (((bool)@ini_get ('short_open_tag') === FALSE) && (false == TRUE)) echo eval ('?>'.preg_replace ("/;*\s*\?>/", "; ?>", str_replace ('<?=', '<?php echo ', file_get_contents ($_oa_path))));
    else include $_oa_path;

    $buffer = ob_get_contents ();
    @ob_end_clean ();

    return $buffer;
  }
}

if (!function_exists ('list_blocks')) {
  function list_blocks ($name, $blocks, $page_count, $tags, $tree) {
    global $_url, $_list, $_oput_format, $_template, $_pagination_limit, $_is_show_next, $_is_show_prev;
    $lis = array ();

    if ($_is_show_next && $name) array_push ($lis, array ('href' => ($name - 1) . $_oput_format, 'content' => '上一頁', 'active' => false));
    for ($i = (!$_pagination_limit || (($name - $_pagination_limit) < 0)) ? 0 : ($name - $_pagination_limit); ($i < $page_count) && (!$_pagination_limit || ($i < ($name + $_pagination_limit + 1))); $i++) array_push ($lis, array ('href' => $i . $_oput_format, 'content' => $i + 1, 'active' => $name == $i));
    if ($_is_show_prev && (($name + 1) != $page_count)) array_push ($lis, array ('href' => ($name + 1) . $_oput_format, 'content' => '下一頁', 'active' => false));

    return write_file ($_list . DIRECTORY_SEPARATOR . $name . $_oput_format,
      load_view ($_template['list']['view'], array (
        'blocks' => $blocks,
        'lis' => $lis,
        'tags' => $tags,
        'my_url' => $_url . '/' . preg_replace ('#(^\.\/)#', '', $_list) . '/' . $name . $_oput_format,
        'tree' => $tree)), 'w+');
  }
}
if (!function_exists ('tags_blocks')) {
  function tags_blocks ($name, $blocks, $page_count, $tag, $tags, $tree) {
    global $_url, $_tags, $_oput_format, $_template, $_pagination_limit, $_is_show_next, $_is_show_prev;
    $lis = array ();

    if ($_is_show_next && $name) array_push ($lis, array ('href' => ($name - 1) . $_oput_format, 'content' => '上一頁', 'active' => false));
    for ($i = (!$_pagination_limit || (($name - $_pagination_limit) < 0)) ? 0 : ($name - $_pagination_limit); ($i < $page_count) && (!$_pagination_limit || ($i < ($name + $_pagination_limit + 1))); $i++) array_push ($lis, array ('href' => $i . $_oput_format, 'content' => $i + 1, 'active' => $name == $i));
    if ($_is_show_prev && (($name + 1) != $page_count)) array_push ($lis, array ('href' => ($name + 1) . $_oput_format, 'content' => '下一頁', 'active' => false));

    $p = $_tags . DIRECTORY_SEPARATOR . $tag . DIRECTORY_SEPARATOR;
    $n = $name . $_oput_format;

    $o = umask (0);
    @mkdir ($p, 0777, true);
    umask ($o);

    return write_file ($p . $n,
      load_view ($_template['tags']['view'], array (
        'blocks' => $blocks,
        'lis' => $lis,
        'now_tag' => $tag,
        'tags' => $tags,
        'my_url' => $_url . '/' . preg_replace ('#(^\.\/)#', '', $_tags) . '/' . $tag . '/' . $n,
        'tree' => $tree)), 'w+');
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

    return $is_root ? @rmdir ($dir) : false;
  }
}
