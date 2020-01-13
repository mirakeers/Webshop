<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kleur
 *
 * @author Myra
 */
class Kleur {
    private $kleurId;
    private $naam;
    private $kleurcode;
    function __construct($kleurId, $naam, $kleurcode) {
        $this->kleurId = $kleurId;
        $this->naam = $naam;
        $this->kleurcode = $kleurcode;
    }
    function getKleurId() {
        return $this->kleurId;
    }

    function getNaam() {
        return $this->naam;
    }

    function getKleurcode() {
        return $this->kleurcode;
    }

    function setKleurId($kleurId) {
        $this->kleurId = $kleurId;
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }

    function setKleurcode($kleurcode) {
        $this->kleurcode = $kleurcode;
    }
}
