<?php
include_once 'Model/ProductVariatie.php';
include_once 'DAO/Verbinding/DatabaseFactory.php';

class ProductVariatieDAO {

    private static function getVerbinding() {
        return DatabaseFactory::getDatabase();
    }

    public static function getProductVariaties() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM ProductVariatie");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }
    
    public static function getProductVariatiesByProductId($productId) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM ProductVariatie WHERE productId=?", array($productId));
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function getProductVariatieById($id) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM ProductVariatie WHERE productVariatieId=?", array($id));
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }
    public static function insert($productVariatie) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO ProductVariatie(productId, kleurId) VALUES ('?','?')", array($productVariatie->getProductId(), $productVariatie->getKleurId()));
    }

    public static function deleteById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM ProductVariatie where productVariatieId=?", array($id));
    }

    public static function delete($productVariatie) {
        return self::deleteById($productVariatie->getProductVariatieId());
    }

    public static function update($productVariatie) {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE ProductVariatie SET productId='?',kleurId='?' WHERE productVariatieId=?", array($productVariatie->getProductId(), $productVariatie->getKleurId(), $productVariatie->getProductVariatieId()));
    }

    protected static function converteerRijNaarObject($databaseRij) {
        return new ProductVariatie($databaseRij['productVariatieId'], $databaseRij['productId'], $databaseRij['kleurId']);
    }

}
