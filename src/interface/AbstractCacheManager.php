<?php

/**
 * Interfaccia utilizzata per gestire i Manager di cache
 */
interface AbstractCacheManager {

    //metodo che aggiunge un'immage in cache
    public function cache($image);
}
