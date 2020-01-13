<?php
    require_once './model/WinkelwagenItem.php';
    require_once './dao/WinkelwagenDAO.php';
    $productVariatieId = $_POST['productVariatieId'];
    $nieuwAantal = $_POST['nieuwAantal'];
    
    WinkelwagenDAO::updateAantalItems($productVariatieId, $nieuwAantal);
    
    //Omdat we de cookie nog niet meteen kunnen accessesen, worden onderstaande waardes berekent aan de hand van een combinatie van de oude waardes in de dao, en de nieuwAantal-variabele
    //dit item is dus nog het oude item
    $item = WinkelwagenDAO::getWinkelwagenItemByProductVariatieId($productVariatieId);
    $product = $item->getProduct();
    $deltaItemAantal = $nieuwAantal - $item->getAantal();
    
    $data = array(
        "itemBestaatNog"=>($nieuwAantal != 0),
        "nieuwItemTotaalPrijsInclBtw"=>number_format($product->getPrijsInclBtw() * $nieuwAantal, 2),
        "nieuwAantalItems"=>  WinkelwagenDAO::getTotaalAantalItems() + $deltaItemAantal,
        "nieuwWinkelwagenTotaalPrijsExclBtw"=> number_format(WinkelwagenDAO::getTotaalPrijsExclBtw() + ($deltaItemAantal * $product->getPrijsExclBtw()), 2),
        "nieuwWinkelwagenTotaalBtw"=>  number_format(WinkelwagenDAO::getTotaalBtw() + ($deltaItemAantal * $product->getBtw()), 2),
        "nieuwWinkelwagenTotaalPrijsInclBtw"=>  number_format(WinkelwagenDAO::getTotaalPrijsInclBtw() + ($deltaItemAantal * $product->getPrijsInclBtw()), 2),
    );
    echo json_encode($data);