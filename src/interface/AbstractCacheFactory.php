<?php

/**
 * Interfaccia per la gestione delle factory riguardanti i gestori di cache
 */
interface AbstractCacheFactory {

    //metodo utilizzato per creare nuovi manager di cache.
    public function createCacheManager();
}
