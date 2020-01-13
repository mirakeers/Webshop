<?php
require_once './dao/ProductVariatieDAO.php';
require_once './dao/ProductDAO.php';

class WinkelwagenItem {
    private $productVariatieId;
    private $aantal;
    
    function __construct($productVariatieId, $aantal) {
        $this->productVariatieId = $productVariatieId;
        $this->aantal = $aantal;
    }
    
    function getProductVariatie() {
        return ProductVariatieDAO::getProductVariatieById($this->productVariatieId);
    }
    function getProduct() {
        return ProductDAO::getProductById($this->getProductVariatie()->getProductId());
    }
    function getTotaalPrijsExclBtw() {
        return $this->getProduct()->getPrijsExclBtw() * $this->aantal;
    }
    function getTotaalBtw() {
        return $this->getProduct()->getBtw() * $this->aantal;
    }
    function getTotaalPrijsInclBtw() {
        return $this->getTotaalPrijsExclBtw() + $this->getTotaalBtw();
    }

    function getProductVariatieId() {
        return $this->productVariatieId;
    }
    
    function getAantal() {
        return $this->aantal;
    }

    function setProductVariatieId($productVariatieId) {
        $this->productVariatieId = $productVariatieId;
    }

    function setAantal($aantal) {
        $this->aantal = $aantal;
    }
}
