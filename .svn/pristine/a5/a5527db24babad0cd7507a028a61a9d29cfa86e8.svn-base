<?php
    require_once './model/WinkelwagenItem.php';
    require_once './dao/WinkelwagenDAO.php';
    $productVariatieId = $_POST['productVariatieId'];
    $aantal = $_POST['aantal'];
    
    WinkelwagenDAO::vermeerderAantalItems($productVariatieId, $aantal);
    
    $data = array(
        "nieuwAantalItems"=>  WinkelwagenDAO::getTotaalAantalItems() + $aantal
    );
    echo json_encode($data);//json_encode(WinkelwagenDAO::getWinkelwagenItems());