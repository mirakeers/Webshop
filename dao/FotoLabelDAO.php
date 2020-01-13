<?php
include_once 'Model/FotoLabel.php';
include_once 'DAO/Verbinding/DatabaseFactory.php';

class FotoLabelDAO {

    private static function getVerbinding() {
        return DatabaseFactory::getDatabase();
    }

    public static function getFotoLabels() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM FotoLabel");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function getFotoLabelById($id) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM FotoLabel WHERE fotoLabelId=?", array($id));
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }
    public static function insert($fotoLabel) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO FotoLabel(label) VALUES ('?')", array($fotoLabel->getLabel()));
    }

    public static function deleteById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM FotoLabel where fotoLabelId=?", array($id));
    }

    public static function delete($fotoLabel) {
        return self::deleteById($fotoLabel->getFotoLabelId());
    }

    public static function update($fotoLabel) {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE FotoLabel SET label='?' WHERE fotoLabelId=?", array($fotoLabel->getLabel(), $fotoLabel->getFotoLabelId()));
    }

    protected static function converteerRijNaarObject($databaseRij) {
        return new FotoLabel($databaseRij['fotoLabelId'], $databaseRij['label']);
    }

}
