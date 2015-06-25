<?php

class Wrapper{
    
    private $imageFactory;
    private $imageManager;
    private $cacheManager;
   
    /**
     *
     * @var array [nome immagine, width] 
     */
    private $imageList;
    /**
     * Cotruttore del wrapper
     * @param type $factoryImage
     * @param type $factoryCache
     */
     function __construct($factoryImage, $factoryCache= null) {
         if(isset($factoryCache))
         {
         $this->cacheFManager=$factoryCache->createCacheManager();
         }
         $this->imageFactory=$factoryImage;
    }
    
    /**
     * 
     * 
     * @param image $image
     * @param value $width
     * @param value $height
     * 
     * @return image
     */
    
    public function main($image,$width,$height)
    {
     //controllo se non ho già l'immagine nel formato che voglio in cache
     if(isset($this->_getImageCache($image, $width, $height))){
         // prendo l'immagine
         return "immagine presente in cache";
     }
     else
     {
         //l'immagine non è ancora in cache
         $this->imageManager=$this->imageFactory->createImageManager($image);
         $imageResized = $this->imageManager->resize($width,$height);
         $imageLink=$this->cacheManager->cache($imageResized);
         array_push($this->imageList,$image,$width,$height,$imageLink);
         return $imageResized;
     }
     
    }
    
    /**con questo metodo controllo se esiste già in cache una specifica immagine nel formato che voglio
     * siccome 
     * 
     * @param type $image
     * @param type $width
     * @param type $height
     */
    private function _getImageCache($image,$width,$height)
    {
        //scorro l'array config in cerca di immagini con gli attributi di interesse
        
        //ritorno il path se trovo l'immagine, altrimenti null
    }
    
}

