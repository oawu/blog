<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

spl_autoload_register(function($className) {
  if (!in_array($className, ['Sitemap', 'GoogleVerification', 'Page404', 'Parsedown', 'Page', 'Pagination', 'Menu', 'SingleItem', 'Item', 'License', 'AllJson', 'Search', 'Article', 'ArticleIndex', 'ArticleReview', 'Album', 'Items', 'Articles', 'Albums']))
    return false;

  if (!is_readable($path = PATH_CMD_LIB_PLUGIN . 'Cover.' . $className . '.php'))
    return false;
  
  include_once $path;

  return class_exists($className);
});

if (!function_exists('argv')) {
  function argv($argv, $keys) {
    $ks = $return = $result = [];

    if (!($argv && $keys))
      return $return;

    foreach ($keys as $key)
      if (is_array($key))
        foreach ($key as $k)
          array_push($ks, $k);
      else
        array_push($ks, $key);

    $key = null;
    
    foreach ($argv as $param)
      if (in_array($param, $ks))
        if (!isset($result[$key = $param]))
          $result[$key] = [];
        else ;
      else if (isset($result[$key]))
        array_push($result[$key], $param);
      else ;

    foreach ($keys as $key)
      if (is_array($key))
        foreach ($key as $k)
          if (isset($result[$k]))
            $return[$key[0]] = isset($return[$key[0]]) ? array_merge($return[$key[0]], $result[$k]) : $result[$k];
          else;
      else if (isset($result[$key]))
        $return[$key] = isset($return[$key]) ? array_merge($return[$key], $result[$key]) : $result[$key];
      else ;
  
    return $return;
  }
}

if (!function_exists('fileRead')) {
  function fileRead($file) {
    if (!file_exists($file))
      return '';
    
    if (function_exists('file_get_contents'))
      return @file_get_contents($file);
    
    $fp = @fopen($file, FOPEN_READ);

    if ($fp === false)
      return '';

    flock($fp, LOCK_SH);

    $data = '';

    if (filesize($file) > 0)
      $data =& fread($fp, filesize($file));

    flock($fp, LOCK_UN);
    fclose($fp);

    return $data;
  }
}

if (!function_exists('pathReplace')) {
  function pathReplace($search, $subject, $replace = '') {
    return preg_replace('/^(' . preg_replace('/\//', '\/', $search) . ')/', $replace, $subject);
  }
}

if (!function_exists('removeHtmlTag')) {
  function removeHtmlTag($text, $space = true) {
    return preg_replace('/\s+/u', $space ? ' ' : '', preg_replace('/&#?[a-z0-9]+;/ui', '', trim(strip_tags($text))));
  }
}

if (!function_exists('removeDir')) {
  function removeDir($path) {
    return !array_filter(array_map(function($file) use ($path) {
      if ($file === '.' || $file === '..' || !file_exists($tmp = $path . $file))
        return false;

      is_file($tmp) ? @unlink($tmp) : @removeDir($tmp . DIRECTORY_SEPARATOR);

      return file_exists($tmp);
    }, @scandir($path) ?: [])) && (@rmdir($path) || !file_exists($path));
  }
}

if (!function_exists('removeDirs')) {
  function removeDirs($dirs) {
    $exclude = array_map(function($t) {
      return PATH . $t . DIRECTORY_SEPARATOR;
    }, ['cmd', 'css', 'font', 'img', 'js', 'markdown', 'scss', 'template']);

    return array_filter(array_map(function($dir) {
      return removeDir($dir) ? null : pathReplace(PATH, $dir);
    }, array_filter($dirs, function($dir) use ($exclude) {
      return !in_array($dir, $exclude);
    })));
  }
}

if (!function_exists('removeRootFiles')) {
  function removeRootFiles($formats = ['html']) {
    return array_filter(array_map(function($file) use ($formats) {
      $tmp = PATH . $file;

      if ($formats && !(file_exists($tmp) && in_array(pathinfo($file, PATHINFO_EXTENSION), $formats)))
        return false;

      @unlink($tmp);

      return file_exists($tmp) ? $file : false;
    }, @scandir(PATH) ?: []));
  }
}

if (!function_exists('removeSingleItem')) {
  function removeSingleItem($classes) {
    return array_filter($classes, function($class) {
      if (!class_exists($class))
        return true;

      if (!file_exists($class::writePath()))
        return false;

      @unlink($class::writePath());

      return file_exists($class::writePath());
    });
  }
}

if (!function_exists('createGitignoreFiles')) {
  function createGitignoreFiles($path) {
    return file_exists($tmp = $path . '.gitignore') || (is_dir($path) && is_writable($path) && fileWrite($tmp, '*') && file_exists($tmp));
  }
}

if (!function_exists('fileWrite')) {
  function fileWrite($path, $data, $mode = 'wb') {
    if (function_exists('file_put_contents'))
      return $data ? @file_put_contents($path, $data) : @touch($path);

    if (!$fp = @fopen($path, $mode))
      return false;

    flock($fp, LOCK_EX);

    for ($result = $written = 0, $length = strlen($data); $written < $length; $written += $result)
      if (($result = fwrite($fp, substr($data, $written))) === false)
        break;

    flock($fp, LOCK_UN);
    fclose($fp);

    return is_int($result);
  }
}

if (!function_exists('mkdir777')) {
  function mkdir777($path) {
    $oldmask = umask(0);
    $return = @mkdir($path, 0777, true);
    umask($oldmask);
    return $return;
  }
}

if (!function_exists('mkdirDirs')) {
  function mkdirDirs($dirs) {
    return array_filter(array_map(function($dir) {
      return mkdir777($dir) && createGitignoreFiles($dir) ? null : pathReplace(PATH, $dir);
    }, $dirs));
  }
}

if (!function_exists('arrayFlatten')) {
  function arrayFlatten($arr) {
    $new = [];
    foreach ($arr as $key => $value)
      if (is_array($value))
        $new = array_merge($new, $value);
      else
        array_push($new, $value);
    return $new;
  }
}

if (!function_exists('writePages')) {
  function writePages($itemsList) {
    return array_map(function($items) {
      return implode(DIRECTORY_SEPARATOR, $items->uris()) . DIRECTORY_SEPARATOR;
    }, array_filter($itemsList, function($items) {
      return !$items->write();
    }));
  }
}

if (!function_exists('writeItems')) {
  function writeItems($items) {
    return array_map(function($item) {
      return pathReplace(PATH, $item->writePath());
    }, array_filter($items, function($item) {
      return !$item->write();
    }));
  }
}

if (!function_exists('writeSingleItem')) {
  function writeSingleItem($classes) {
    return array_filter($classes, function($class) {
      return !$class::write();
    });
  }
}

if (!function_exists('loadView')) {
  function loadView($___B10g___aT_GiNkg0___path___B10g___aT_GiNkg0___, $___B10g___aT_GiNkg0___pARams___B10g___aT_GiNkg0___ = []) {
    if (!is_readable($___B10g___aT_GiNkg0___path___B10g___aT_GiNkg0___))
      return '';

    extract($___B10g___aT_GiNkg0___pARams___B10g___aT_GiNkg0___);
    ob_start();

    include $___B10g___aT_GiNkg0___path___B10g___aT_GiNkg0___;
    $buffer = ob_get_contents();
    @ob_end_clean();

    return $buffer;
  }
}

if (!function_exists('attr')) {
  function attr($attrs, $exclude = []) {
    $attrs = array_filter($attrs, function($attr) { return $attr !== null; });
    $attrs = array_filter(array_map(function($k, $v) use ($exclude) { if ($exclude && in_array($k, $exclude)) return ''; return is_bool($v) ? $v === true ? $k : '' : ($k . '="' . $v . '"'); }, array_keys($attrs), array_values($attrs)));
    return $attrs ? ' ' . implode(' ', $attrs) : '';
  }
}

if (!function_exists('oasort')) {
  function oasort($n, $b = false, $c = false) {
    if ($n == 0)
      return [];
    
    if ($n == 1)
      return ['n11'];

    if ($n == 2)
      return ['n2 n21', 'n2 n22'];

    if ($n == 3)
      return $c ? ['n3 n34', 'n3 n35', 'n3 n36'] : ['n3 n31', 'n3 n32', 'n3 n33'];

    if (!($n % 3) && ($n / 3) < 4)
      return array_merge($c ? ['n3 n34', 'n3 n35', 'n3 n36'] : ['n3 n31', 'n3 n32', 'n3 n33'], oasort($n - 3, $b, $c ? false : true));

    $s = $b ? 2 : 3;
    $v = $n - $s;

    return array_merge($s == 3 ? $c ? ['n3 n34', 'n3 n35', 'n3 n36'] : ['n3 n31', 'n3 n32', 'n3 n33'] : ['n2 n21', 'n2 n22'], oasort($v, !$b, $s == 3 ? $c ? false : true : $c));
  }
}

if (!function_exists('jsonLd')) {
  function jsonLd($jsonLd = []) {
    return $jsonLd ? '<script type="application/ld+json">' . json_encode ($jsonLd, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' : '';
  }
}