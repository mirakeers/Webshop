<?php
//In deze klasse moet je in principe alleen de connectiegegevens voor jou mysql server aanpassen.
include_once 'DAO/Verbinding/Database.php';

class DatabaseFactory {

    //Singleton
    private static $verbinding;

    public static function getDatabase() {

        if (self::$verbinding == null) {
            $mijnComputernaam = "dt5.ehb.be";
            $mijnGebruikersnaam = "bwdwerkst1617038";
            $mijnWachtwoord = "69312478";
            $mijnDatabase = "bwdwerkst1617038";
            //$mijnComputernaam = "localhost";
            //$mijnGebruikersnaam = "webontwikkelaar";
            //$mijnWachtwoord = "ehb";
            //$mijnDatabase = "bwdwerkst1617038";
            self::$verbinding = new Database($mijnComputernaam, $mijnGebruikersnaam, $mijnWachtwoord, $mijnDatabase);
        }
        return self::$verbinding;
    }

}
?>

