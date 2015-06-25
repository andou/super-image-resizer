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
    
    //variabili l
    private $imageFactory;
    private $cacheFactory;
    

    public static function getInstance() {
        $classname = __CLASS__;
        return new $classname;
    }

    public function init($factoryImage, $factoryCache, $inifile) {
        $this->_init($factoryImage, $factoryCache, $inifile);
        $this->_initialized = TRUE;
        // qui dobbiamo cominciare a buttare un'occhio al file ini.
        $this->imageFactory = $factoryImage;
        $this->cacheFactory = $factoryCache;
        return $this;
    }

    public function run($image) {
        if (!$this->_initialized) {
            die('Applicaiton not initialized: check the .ini file');
        }
        //creo il wrapper
        //lancio l'esecuzione del wrapper
    }

    protected function _init($factoryImage, $factoryCache, $inifile) {
        $this->_configs = Inireader::getInstance($inifile, TRUE);
    }

    public function getConfigs() {
        return $this->_configs;
    }

}
