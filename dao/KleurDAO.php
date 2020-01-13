<?php
include_once 'Model/Kleur.php';
include_once 'DAO/Verbinding/DatabaseFactory.php';

class KleurDAO {

    private static function getVerbinding() {
        return DatabaseFactory::getDatabase();
    }

    public static function getKleuren() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Kleur");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarObject($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function getKleurById($id) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Kleur WHERE kleurId=?", array($id));
        if ($resultaat->num_rows == 1) {
            $databaseRij = $resultaat->fetch_array();
            return self::converteerRijNaarObject($databaseRij);
        } else {
            //Er is waarschijnlijk iets mis gegaan
            return false;
        }
    }
    public static function insert($kleur) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO Kleur(naam, kleurcode) VALUES ('?','?')", array($kleur->getNaam(), $kleur->getKleurcode()));
    }

    public static function deleteById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM Kleur where kleurId=?", array($id));
    }

    public static function delete($kleur) {
        return self::deleteById($kleur->getKleurId());
    }

    public static function update($kleur) {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE Kleur SET naam='?',kleurcode='?' WHERE kleurId=?", array($kleur->getNaam(), $kleur->getKleurcode(), $kleur->getKleurId()));
    }

    protected static function converteerRijNaarObject($databaseRij) {
        return new Kleur($databaseRij['kleurId'], $databaseRij['naam'], $databaseRij['kleurcode']);
    }

}
