<?php

/**
 * interfaccia utilizzata per gestire tutti i Manager di immagini
 */
interface AbstractImageManager {

    //metodo utilizzato per ridimensionare un immagine date larghezza e altezza.
    public function resize($width, $height);
}
