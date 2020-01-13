<?php
    require_once './model/WinkelwagenItem.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WinkelwagenDAO
 *
 * @author Myra
 */
class WinkelwagenDAO {
    public static function getWinkelwagenItems() {
        $items = array();
        if(isset ($_COOKIE['winkelwagen'])){
            $items = unserialize($_COOKIE['winkelwagen']);
        }
        return $items;
    }
    public static function getWinkelwagenItemByProductVariatieId($productVariatieId) {
        $items = array();
        if(isset ($_COOKIE['winkelwagen'])){
            $items = unserialize($_COOKIE['winkelwagen']);
        }
        foreach($items as $item) {
            if($item->getProductVariatieId() == $productVariatieId) {
                return $item;
            }
        }
        return false;
    }
    public static function getTotaalAantalItems() {
        $resultaat = 0;
        $items = self::getWinkelwagenItems();
        foreach ($items as $item) {
           $resultaat += $item->getAantal();
        }
        return $resultaat;
    }
    public static function vermeerderAantalItems($productVariatieId, $aantal) {
        $items = array();
        if(isset ($_COOKIE['winkelwagen'])){
            $items = unserialize($_COOKIE['winkelwagen']);
        }
        $hitfound = false;
        foreach($items as $i => $item) {
            if($item->getProductVariatieId() == $productVariatieId) {
                $items[$i]->setAantal($item->getAantal() + $aantal);
                $hitfound = true;
                break;
            }
        }
        if(!$hitfound) {
            $item = new WinkelwagenItem($productVariatieId, $aantal);
            array_push($items, $item);
        }
        setcookie('winkelwagen', serialize($items), time()+60*60*24*30);
    }
    public static function updateAantalItems($productVariatieId, $aantal) {
        $items = array();
        if(isset ($_COOKIE['winkelwagen'])){
            $items = unserialize($_COOKIE['winkelwagen']);
        }
        $hitfound = false;
        foreach($items as $i => $item) {
            if($item->getProductVariatieId() == $productVariatieId) {
                if($aantal > 0) {
                    $items[$i]->setAantal($aantal);
                } else {
                    unset($items[$i]);
                }
                $hitfound = true;
                break;
            }
        }
        if(!$hitfound && $aantal>0) {
            $item = new WinkelwagenItem($productVariatieId, $aantal);
            array_push($items, $item);
        }
        setcookie('winkelwagen', serialize($items), time()+60*60*24*30);
    }
    
    public static function getTotaalPrijsExclBtw() {
        $resultaat = 0;
        $items = self::getWinkelwagenItems();
        foreach ($items as $item) {
           $resultaat += $item->getTotaalPrijsExclBtw();
        }
        return $resultaat;
    }
    public static function getTotaalBtw() {
        $resultaat = 0;
        $items = self::getWinkelwagenItems();
        foreach ($items as $item) {
           $resultaat += $item->getTotaalBtw();
        }
        return $resultaat;
    }
    public static function getTotaalPrijsInclBtw() {
        $resultaat = 0;
        $items = self::getWinkelwagenItems();
        foreach ($items as $item) {
           $resultaat += $item->getTotaalPrijsInclBtw();
        }
        return $resultaat;
    }
    
    //DEBUG METHODE
    public static function printCookie() {
        $str = "there is no cookie 'winkelwagen'";
        if(isset ($_COOKIE['winkelwagen'])){
            $items = unserialize($_COOKIE['winkelwagen']);
            $str = print_r($items);
        }
        return $str;
    }
}
