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
    
    public function main($imageLink,$width,$height)
    {
     //controllo se non ho già l'immagine nel formato che voglio in cache
     $imagePath=$this->_getImageCachePath($imageLink, $width, $height);
     if(isset(file_exists($imagePath))){
         //l'immagine è già presente in cache, ritorno quindi 
         return $imagePath;
     }
     else
     {
         //l'immagine non è ancora in cache
         $this->imageManager=$this->imageFactory->createImageManager($imageLink);
         $imageResized = $this->imageManager->resize($width,$height);
         $imageLink=$this->cacheManager->cache($imageResized);
         array_push($this->imageList,$imageLink,$width,$height);
         return $imageResized;
     }
     
    }
    
    /**con questo metodo crea il path dell'immagine in cache
     * siccome 
     * 
     * @param type $image
     * @param type $width
     * @param type $height
     */
    private function _getImageCachePath($imageName,$width,$height)
    {
        $path=$width."x".$height;
        $path=$path."\\";
        $path=$path.(strtolower(substr($image, 0)));
        $path=$path."\\";
        $path=$path.$imageName;
        return $path;
    }
    
}

