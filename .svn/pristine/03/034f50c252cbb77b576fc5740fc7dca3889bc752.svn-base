<?php
include_once 'Model/ProductCategorie.php';
include_once 'DAO/Verbinding/DatabaseFactory.php';

class ProductCategorieDAO {

    private static function getVerbinding() {
        return DatabaseFactory::getDatabase();
    }

    public static function getProductCategorieen() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM ProductCategorie");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function getProductCategorieById($id) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM ProductCategorie WHERE productCategorieId=?", array($id));
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }
    public static function insert($productCategorie) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO ProductCategorie(naam) VALUES ('?')", array($productCategorie->getNaam()));
    }

    public static function deleteById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM ProductCategorie where productCategorieId=?", array($id));
    }

    public static function delete($productCategorie) {
        return self::deleteById($productCategorie->getProductCategorieId());
    }

    public static function update($productCategorie) {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE ProductCategorie SET naam='?' WHERE productCategorieId=?", array($productCategorie->getNaam(), $productCategorie->getProductCategorieId()));
    }

    protected static function converteerRijNaarObject($databaseRij) {
        return new ProductCategorie($databaseRij['productCategorieId'], $databaseRij['naam']);
    }

}
