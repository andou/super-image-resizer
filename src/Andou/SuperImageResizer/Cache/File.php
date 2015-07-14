<?php

namespace Andou\SuperImageResizer\Cache;

class File extends \Andou\SuperImageResizer\Cache {

  protected $_cache_pool;

  public function __construct($cache_pool) {
    $this->_cache_pool = $cache_pool;
  }

  public function load($id) {
    $filename = $this->_getFilePosition($id);
    return file_exists($filename) ? $filename : FALSE;
  }

  public function test($id) {
    
  }

  public function save($img, $id) {
    $destination = $this->_getFilePosition($id);
    if (!file_exists(dirname($destination))) {
      mkdir(dirname($destination), 0777, true);
    }
    $img->save($this->_getFilePosition($id));
  }

  public function remove($id) {
    
  }

  public function clean($mode) {
    
  }

  protected function _getFilePosition($id) {
    $data = $this->readCacheId($id);
    return sprintf("%s/%s/%s/%s/%s", $this->_cache_pool, $data['width'], $data['height'], md5(dirname($data['filename'])), basename($data['filename']));
  }

}
