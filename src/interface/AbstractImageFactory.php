<?php

/* 
 * Interfaccia di creazione Factory riguardanti le classi per la  gestione delle immagini
 */

interface AbstractImageFactory {

    //metodo per la creazione di gestori di immagini
    public function createImageManager();
}
