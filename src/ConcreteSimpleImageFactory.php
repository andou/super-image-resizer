<?php

/**
 * Classe utilizzata per creare un gestore delle imagini bastato sulla libreria SimpleImage importata
 */
class ConcreteSimpleImageFactory implements AbstractImageFactory {

//metodo utilizzato per creare l'istanza della classe BridgeSimpleImage
    public function createImageManager($image) {
        return new BridgeSimpleImage($image);
    }

}
