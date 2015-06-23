<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Andou\super_image_resizer;

use Andou\Inireader;
use Andou\Autoloader;

class App {

    /**
     * Are we?
     *
     * @var boolean 
     */
    protected $_initialized = FALSE;

    /**
     *
     * @var \Andou\Inireader\Inireader
     */
    protected $_configs;

    public static function getInstance() {
        $classname = __CLASS__;
        return new $classname;
    }

    public function init($factoryImage, $factoryCache, $inifile) {
        $this->_init($factoryImage, $factoryCache, $inifile);
        $this->_initialized = TRUE;
        return $this;
    }

    public function run() {
        if (!$this->_initialized) {
            die('Applicaiton not initialized: check the .ini file');
        }
    }

    protected function _init($factoryImage, $factoryCache, $inifile) {
        $this->_configs = Inireader::getInstance($inifile, TRUE);
    }

    public function getConfigs() {
        return $this->_configs;
    }

}
