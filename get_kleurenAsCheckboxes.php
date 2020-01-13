<?php
    require_once './dao/KleurDAO.php';
    require_once './model/Kleur.php';
    
    $kleuren = KleurDAO::getKleuren();
    foreach ($kleuren as $kleur) {
    ?>
        <label><input type="checkbox" name="kleurIds[]" value="<?php echo $kleur->getKleurId()?>"> <?php echo ucwords($kleur->getNaam())?></label>
    <?php
    }
?>