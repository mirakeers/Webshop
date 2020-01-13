<?php
    require_once './model/Kleur.php';
    require_once './dao/KleurDAO.php';
    
    $naam = $_POST['kleurNaam'];
    $kleurcode = $_POST['kleurCode'];
    
    KleurDAO::insert(new Kleur(0, $naam, $kleurcode));