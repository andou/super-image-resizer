<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Andou\SuperImageResizer;

use Andou\Inireader;

class App {

  /**
   * Base directory
   *
   * @var string
   */
  protected $_base_dir;

  /**
   * Location of the config file
   *
   * @var string
   */
  protected $_config_file;

  /**
   * The app configurations
   *
   * @var array
   */
  protected $_configs;

  /**
   * The cache handler
   *
   * @var \Andou\SuperImageResizer\Cache 
   */
  protected $_cache_handler;

  /**
   * Singleton instance
   *
   * @var \Andou\SuperImageResizer\App 
   */
  protected static $_instance;

  /**
   * Returns an instance of this class
   * 
   * @return \Andou\SuperImageResizer\App
   */
  public static function getInstance($basedir, $inifile) {
    if (!isset(self::$_instance)) {
      $classname = __CLASS__;
      self::$_instance = new $classname($basedir, $inifile);
    }
    return self::$_instance;
  }

  /**
   * Inits the class
   * 
   * @param string $inifile
   */
  public function __construct($basedir, $inifile) {
    $this->_base_dir = $basedir;
    $this->_config_file = $this->getPath($inifile);
  }

  public function getImageResized($image, $width, $height = null) {
    $resizer = new \Andou\SuperImageResizer\Resizer\Image($this->_getCacheHandler());
    return $resizer->getImageResized($this->_getSourceImagePath($image), $width, $height);
  }

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////  CACHE MANAGEMENT  ////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  /**
   * 
   * @return \Andou\SuperImageResizer\Cache
   */
  protected function _getCacheHandler() {
    if (!isset($this->_cache_handler)) {
      $cache_type = $this->_getConfigs()->getCacheType();
      $cache_type_classname = $cache_type ? "Andou\SuperImageResizer\Cache\\" . $cache_type : 'Andou\SuperImageResizer\Cache\File';
      switch ($cache_type) {
        case "File":
          $this->_cache_handler = new $cache_type_classname($this->_getConfigs()->getCacheFolder());
          break;
        default :
          $this->_cache_handler = new $cache_type_classname();
          break;
      }
    }
    return $this->_cache_handler;
  }

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////  PATH MANAGEMENT  //////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  public function _getSourceImagePath($image) {
    return $this->getPath("/" . $this->_getConfigs()->getImagesPool() . "/" . $image);
  }

  /**
   * Returns a path starting from a relative path
   * 
   * @param string $subpath
   * @param boolean $use_base_dir
   */
  public function getPath($subpath, $use_base_dir = TRUE) {
    $res = $subpath;
    if ($use_base_dir) {
      $res = $this->_base_dir . $res;
    }
    return $res;
  }

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////  CONFIGS MANAGEMENT  //////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  /**
   * Loads the configurations
   * 
   * @param type $inifile
   * @return type
   */
  protected function _loadConfigs($inifile) {
    return \Andou\Inireader\Inireader::getInstance($inifile, TRUE);
  }

  /**
   * Returns the configurations
   * 
   * @return array
   */
  protected function _getConfigs() {
    if (!isset($this->_configs)) {
      $this->_configs = $this->_loadConfigs($this->_config_file);
    }
    return $this->_configs;
  }

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////  ERRORS MANAGEMENT  //////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  /**
   * Kills the application with a specific error
   * 
   * @param string $error_message
   */
  protected function _error($error_message) {
    die($error_message);
  }

}