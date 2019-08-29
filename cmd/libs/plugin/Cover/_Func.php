<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

spl_autoload_register(function($className) {
  if (!is_readable($path = PATH_CMD_LIB_PLUGIN_COVER . $className . '.php'))
    return false;
  
  include_once $path;

  return class_exists($className);
});

if (!function_exists('getNamespaces')) {
  function getNamespaces($className) {
    return array_slice(explode('\\', $className), 0, -1);
  }
}

if (!function_exists('deNamespace')) {
  function deNamespace($className) {
    $className = array_slice(explode('\\', $className), -1);
    return array_shift($className);
  }
}

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

if (!function_exists('cleanDist')) {
  function cleanDist($dir) {
    return array_filter(array_map(function($name) use ($dir) {
      if ($name === '.' || $name === '..' || !file_exists($path = $dir . $name))
        return false;

      is_file($path)
        ? @unlink($path)
        : cleanDist($path . DIRECTORY_SEPARATOR) || @rmdir($path . DIRECTORY_SEPARATOR);

      return file_exists($path);
    }, @scandir($dir) ?: []));
  }
}

if (!function_exists('cloneDirs')) {
  function cloneDirs($dirs) {

    return array_filter(array_map(function($key, $val) {
      if (!file_exists($key))
        return false;

      file_exists($val) || mkdir777($val);

      if (!file_exists($val) || is_file($val) || !is_writable($val))
        return true;

      return array_filter(array_map(function($name) use ($key, $val) {
        if ($name === '.' || $name === '..' || !file_exists($path = $key . $name))
          return false;

        is_file($path)
          ? @copy($path, $val . $name)
          : cloneDirs([$path . DIRECTORY_SEPARATOR => $val . $name . DIRECTORY_SEPARATOR]);
  
        return !file_exists($val . $name);
      }, @scandir($key) ?: []));

    }, array_keys($dirs), array_values($dirs)));
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
      return mkdir777($dir)
        ? null
        : pathReplace(PATH_DIST, $dir);
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
      return pathReplace(PATH_DIST, $item->writePath());
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
  function attr($attrs, $excludes = [], $symbol = '"') {
    $attrs = array_filter($attrs, function($attr) { return $attr !== null; });

    is_string($excludes) && $excludes = [$excludes];
    if ($excludes)
      foreach ($attrs as $key => $value)
        if (in_array($key, $excludes))
          unset($attrs[$key]);

    $attrs = array_map(function($k, $v) use ($symbol) { return is_bool($v) ? $v === true ? $k : '' : ($k . '=' . $symbol . $v . $symbol); }, array_keys($attrs), array_values($attrs));
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

if (!function_exists('scope')) {
  function scope($scopes) {
    return implode("\n", array_map(function($scope) {
      return \HTML\Div(
        \HTML\A(
          \HTML\Span($scope['item']['name'])->itemprop('title')))->class('itemscope')->itemscope(true)->itemtype('http://data-vocabulary.org/Breadcrumb');
    }, array_filter($scopes, function($scope) {
      return !empty($scope['item']['url']) && !empty($scope['item']['name']);
    })));
  }
}


if (!function_exists('typeOfImg')) {
  function typeOfImg($t) {
    return 'image/' . (($t = pathinfo(OG_IMG_URL)) && isset($t['extension']) && $t['extension'] ? $t['extension'] : 'jpg');
  }
}