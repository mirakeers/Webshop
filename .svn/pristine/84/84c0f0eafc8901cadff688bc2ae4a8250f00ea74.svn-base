<?php
    require_once './dao/FotoLabelDAO.php';
    require_once './model/FotoLabel.php';
    
    $fotoLabels = FotoLabelDAO::getFotoLabels();
    foreach ($fotoLabels as $label) {
    ?>
        <option value="<?php echo $label->getFotoLabelId()?>"><?php echo ucwords($label->getLabel())?></option>
    <?php
    }
?>