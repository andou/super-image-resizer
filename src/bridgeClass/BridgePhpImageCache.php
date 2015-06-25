<?php

//utilizziamo la libreria per la cache
use nielse63\phpimagecache;

/**
 * implementiamo l'interfaccia di abstract Factory
 */
class BridgePhpImageCache implements AbstractCacheManager {

    protected $_phpImageCache;

    //istanziamo l'oggetto di tipo phpimagecache.
    function __construct() {
        $this->_phpImageCache = new phpimagecache();
    }

    /**Prende in ingresso un file immagine, lo salva in cache e ritorna il suo rispettivo path.
     * 
     * @param image file
     * @return image cache path
     */
    public function cache($image) {
        return $this->_phpImageCache->cache($image);
    }

}
