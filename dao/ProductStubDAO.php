<?php
    require_once './model/Product.php';
    require_once './dao/ProductVariatieDAO.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductDao
 *
 * @author Myra
 */
class ProductStubDAO {
    static function getProducten() {
        $product1 = new Product(1,
                "T-Shirt Divine Factory", 
                "Cupcake ipsum dolor sit. Amet marzipan cheesecake pie muffin tiramisu. Toffee oat cake jelly-o soufflé gingerbread topping ice cream dessert bonbon. Oat cake cake donut donut chocolate bar muffin biscuit. Apple pie brownie dragée jelly beans. Muffin tootsie roll liquorice cotton candy tiramisu. Gummies sweet roll dragée tiramisu apple pie powder sweet roll apple pie.", 
                0.21,
                4.12, 
                "Shirts", 
                ProductVariatieDAO::getProductVariatiesByProductId(1));
        $product2 = new Product(2,
                "Hemd Easy Iron", 
                "Jelly-o gummi bears liquorice cheesecake sweet roll bonbon macaroon chocolate cake. Lemon drops chocolate toffee chupa chups. Topping candy tiramisu wafer brownie halvah pastry.",
                0.21,
                12.39, 
                "Shirts", 
                ProductVariatieDAO::getProductVariatiesByProductId(2));
        $product3 = new Product(3,
                "Skinny Low Trashed Jeans", 
                "Biscuit sugar plum gummies candy canes. Sweet pie powder oat cake marzipan soufflé marshmallow. Liquorice sesame snaps dessert chocolate bar chupa chups cotton candy cake jelly-o jelly. Soufflé cotton candy cake topping jujubes tootsie roll apple pie.",
                0.21,
                24.79, 
                "Pants", 
                ProductVariatieDAO::getProductVariatiesByProductId(3));
        
        $resultaat = array($product1, $product2, $product3);
        return $resultaat;
    }
    static function getProductById($productId) {
        $producten = self::getProducten();
        foreach ($producten as $index => $val) {
            if($val->getProductId() == $productId) {
                return $val;
            }
        }
    }
}
