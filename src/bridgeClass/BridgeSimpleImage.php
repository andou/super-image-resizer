<?php

namespace Andou\super_image_resizer;

use abeautifulsite\SimpleImage;

class BridgeSimpleImage extends AbstractImageManager {

    protected $_simpleImage;

    function __construct($image) {
        $this->_simpleImage = new SimpleImage($image);
    }

    //funzione ereditata dall'interfaccia
    public function resize($width, $height) {
        return $this->_simpleImage->resize($width, $height);
    }

}
