<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductCategorie
 *
 * @author Myra
 */
class ProductCategorie {
    private $productCategorieId;
    private $naam;
    
    function __construct($productCategorieId, $naam) {
        $this->productCategorieId = $productCategorieId;
        $this->naam = $naam;
    }
    
    function getProductCategorieId() {
        return $this->productCategorieId;
    }

    function getNaam() {
        return $this->naam;
    }

    function setProductCategorieId($productCategorieId) {
        $this->productCategorieId = $productCategorieId;
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }


}
