<?php
    require_once './dao/ProductCategorieDAO.php';
    require_once './model/ProductCategorie.php';
    
    $productCategories = ProductCategorieDAO::getProductCategorieen();
    foreach ($productCategories as $categorie) {
    ?>
        <option value="<?php echo $categorie->getProductCategorieId()?>"><?php echo ucwords($categorie->getNaam())?></option>
    <?php
    }
?>