<?php

namespace Andou\SuperImageResizer;

abstract class Cache {

  protected static $_cache_id_separator = "#";

  abstract public function load($id);

  abstract public function test($id);

  abstract public function save($data, $id);

  abstract public function remove($id);

  abstract public function clean($mode);

  public function getCacheId() {
    $arg_list = func_get_args();
    $cache_key = implode(self::$_cache_id_separator, $arg_list);
    return $cache_key;
  }

  protected function readCacheId($cacheId) {
    $res = array();
    list($res['filename'], $res['width'], $res['height'] ) = explode(self::$_cache_id_separator, $cacheId);
    return $res;
  }

  public function constructCacheId($filename, $width, $height) {
    return $this->getCacheId($filename, $width, $height);
  }

  protected function cleanFilename($filename) {
    return str_replace(self::$_cache_id_separator, "", $filename);
  }

}
