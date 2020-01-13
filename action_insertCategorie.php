<?php
    require_once './model/ProductCategorie.php';
    require_once './dao/ProductCategorieDAO.php';
    
    $naam = $_POST['categorieNaam'];
    
    ProductCategorieDAO::insert(new ProductCategorie(0, $naam));