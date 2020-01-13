<?php
include_once 'Model/Foto.php';
include_once 'DAO/Verbinding/DatabaseFactory.php';

class FotoDAO {

    private static function getVerbinding() {
        return DatabaseFactory::getDatabase();
    }

    public static function getFotos() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Foto");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function getFotosByProductVariatieId($variatieId) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Foto WHERE productVariatieId=? ORDER BY prioriteit", array($variatieId));
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }
    
    public static function getFotosByProductId($productId) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Foto f JOIN ProductVariatie pv ON f.productVariatieId = pv.productVariatieId WHERE pv.productId = ?", array($productId));
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }
    
    public static function getFotoOfTypeProductByProductVariatieId($variatieId) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Foto WHERE productVariatieId=? AND fotoLabelId = 2 ORDER BY prioriteit LIMIT 1", array($variatieId));
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Foto WHERE productVariatieId=? ORDER BY prioriteit LIMIT 1", array($variatieId));
            if ($resultaat->num_rows == 1) {
                $databaseRij = $resultaat->fetch_array();
                return self::converteerRijNaarObject($databaseRij);
            } else {
                return false;
            }
        }
    }

    public static function getFotoById($id) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Foto WHERE fotoId=?", array($id));
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }
    
    static function getFotoByProductVariatieIdAndPrioriteit($productVariatieId, $prioriteit) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Foto WHERE productVariatieId=? AND prioriteit=?", array($productVariatieId, $prioriteit));
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            return false;
        }
    }

    public static function insert($foto) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO Foto(locatieFull, locatieThumb, productVariatieId, fotoLabelId, prioriteit) VALUES ('?','?','?','?','?')", array($foto->getLocatieFull(), $foto->getLocatieThumb(), $foto->getProductVariatieId(), $foto->getFotoLabelId(), $foto->getPrioriteit()));
    }

    public static function deleteById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM Foto where fotoId=?", array($id));
    }

    public static function delete($foto) {
        return self::deleteById($foto->getFotoId());
    }

    public static function update($foto) {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE Foto SET locatieFull='?', locatieThumb='?', productVariatieId='?', fotoLabelId='?', prioriteit='?' WHERE fotoId=?", array($foto->getLocatieFull(), $foto->getLocatieThumb(), $foto->getProductVariatieId(), $foto->getFotoLabelId(), $foto->getPrioriteit(), $foto->getFotoId()));
    }

    protected static function converteerRijNaarObject($databaseRij) {
        return new Foto($databaseRij['fotoId'], $databaseRij['locatieFull'], $databaseRij['locatieThumb'], $databaseRij['productVariatieId'], $databaseRij['fotoLabelId'], $databaseRij['prioriteit']);
    }

}
