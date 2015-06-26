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
    
    //path della cartella in cui salvo in locale le immagini.
    private $_imageFolder="/superImage/";
    
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

    public function run($image,$width,$height) {
        if (!$this->_initialized) {
            die('Applicaiton not initialized: check the .ini file');
        }
        //creo il wrapper
        $wrapper= new Wrapper($this->imageFactory,$this->cacheFactory);
        //lancio l'esecuzione del wrapper
        $wrapper->main($image,$width,$height);
    }

    protected function _init($factoryImage, $factoryCache, $inifile) {
        $this->_configs = Inireader::getInstance($inifile, TRUE);
    }

    protected function _getConfigs() {
        return $this->_configs;
    }
    
}
