<?php

namespace Andou\SuperImageResizer\Resizer;

class Image {

  /**
   * The cache handler
   *
   * @var \Andou\SuperImageResizer\Cache 
   */
  protected $_cache_handler;

  /**
   * Class constructor
   * 
   * @param type $cache_handler
   */
  public function __construct($cache_handler) {
    $this->_cache_handler = $cache_handler;
  }

  /**
   * Resizes an image
   * 
   * @param string $filename
   * @param int $width
   * @param int $height
   */
  public function getImageResized($filename, $width, $height = null) {

    if (empty($width) && empty($height)) {
      throw new Exception("Specify width and/or height");
    }

    $orig_dims = $this->_getOriginalDimensions($filename);

    if (!isset($height)) {
      $height = $this->_calculateH($orig_dims, $width);
    }

    if (!isset($width)) {
      $width = $this->_calculateW($orig_dims, $height);
    }

    $id = $this->_cache_handler->getCacheId($filename, $width, $height);
    $image = $this->_cache_handler->load($id);
    if ($image === FALSE) {
      $_img = $this->_resize($filename, $width, $height);
      $this->_cache_handler->save($_img, $id);
      $image = $this->_cache_handler->load($id);
    }
    return $image;
  }

  protected function _resize($filename, $width, $height) {
    $_img = new \abeautifulsite\SimpleImage($filename);
    $_img->resize($width, $height);
    return $_img;
  }

  protected function _getOriginalDimensions($filename) {
    $res = array();
    $_img = new \abeautifulsite\SimpleImage($filename);
    $res['w'] = $_img->get_width();
    $res['h'] = $_img->get_height();
    return $res;
  }

  protected function _calculateH($orig_dims, $width) {
    return (int) (($orig_dims['h'] * $width) / (float) $orig_dims['w']);
  }

  protected function _calculateW($orig_dims, $height) {
    return (int) (($orig_dims['w'] * $height) / (float) $orig_dims['h']);
  }

}
