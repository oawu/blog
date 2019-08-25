<?php

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2019, Ginkgo
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */

class Article extends Item {

  public function others($length = 4) {
    $uris = implode('_', $this->uris());
    $groups = Item::groups();

    $keys = array_keys($groups);
    for ($i = -1, $j = 0, $c = count($keys); $j < $c; $j++)
      if ($keys[$j] == $uris) {
        $i = $j;
        break;
      }

    $others = [];
    $keys = array_merge(array_splice($keys, $i), $keys);

    foreach ($keys as $key) {
      $group = array_key_exists($key, $groups) ? $groups[$key] : [];
      
      if ($uris == $key) {
        $tags = array_values(array_filter($group, function($other) {
          return $other->tags && $this->tags && array_filter($other->tags, function($tag) {
            return in_array($tag, $this->tags);
          });
        }));

        for ($i = 0, $c = count($tags); $i < $c; $i++)
          if ($tags[$i] == $this)
            break;

        $tags = array_merge(array_splice($tags, $i), $tags);
        $i == $c || array_shift($tags);


        $tmps = array_values(array_filter($group, function($other) use ($tags) {
          return !array_filter($other->tags, function($tag) use ($tags) {
            return in_array($tag, $tags);
          });
        }));

        for ($i = 0, $c = count($tmps); $i < $c; $i++)
          if ($tmps[$i] == $this)
            break;
        
        $tmps = array_merge(array_splice($tmps, $i), $tmps);
        $i == $c || array_shift($tmps);

        $tags = array_values(array_merge($tags, $tmps));
      } else {
        $tags = $group;
      }
      
      $others = array_values(array_merge($others, $tags));

      if (count($others) >= $length)
        return array_slice($others, 0, $length);
    };

    return [];
  }

  public function write() {
    return fileWrite($this->writePath(), loadView(PATH_TEMPLATE . 'Article.php', [
      '_Checkbox' => loadView(PATH_TEMPLATE . '_Checkbox.php'),
      '_Header' => loadView(PATH_TEMPLATE . '_Header.php', ['item' => $this]),
      '_Menu' => loadView(PATH_TEMPLATE . '_Menu.php', ['currentUrl' => $this->currentUrl()]),
      '_Info' => loadView(PATH_TEMPLATE . '_Info.php'),
      'article' => $this,
    ]));
  }
}