<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Myra
 */
class Product {
   private $productId;
   private $naam;
   private $beschrijving;
   private $prijsExclBtw;
   private $btwPercentage; //vb: 0.21
   private $productCategorieId;
  
   
   function __construct($productId, $naam, $beschrijving, $prijsExclBtw, $btwPercentage, $productCategorieId) {
       $this->productId = $productId;
       $this->naam = $naam;
       $this->beschrijving = $beschrijving;
       $this->prijsExclBtw = $prijsExclBtw;
       $this->btwPercentage = $btwPercentage;
       $this->productCategorieId = $productCategorieId;
   }

   function getProductId() {
       return $this->productId;
   }

   function getNaam() {
       return $this->naam;
   }

   function getBeschrijving() {
       return $this->beschrijving;
   }

   function getPrijsExclBtw() {
       return $this->prijsExclBtw;
   }

   function getBtwPercentage() {
       return $this->btwPercentage;
   }

   function getProductCategorieId() {
       return $this->productCategorieId;
   }
 
   function getBtw() {
       return $this->prijsExclBtw * $this->btwPercentage;
   }
   
   function getPrijsInclBtw() {
       return $this->getBtw() + $this->prijsExclBtw;
   }
   
   function setProductId($productId) {
       $this->productId = $productId;
   }

   function setNaam($naam) {
       $this->naam = $naam;
   }

   function setBeschrijving($beschrijving) {
       $this->beschrijving = $beschrijving;
   }

   function setPrijsExclBtw($prijsExclBtw) {
       $this->prijsExclBtw = $prijsExclBtw;
   }

   function setBtwPercentage($btwPercentage) {
       $this->btwPercentage = $btwPercentage;
   }

   function setProductCategorieId($productCategorieId) {
       $this->productCategorieId = $productCategorieId;
   }


}
