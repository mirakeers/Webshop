<?php
    require_once './dao/ProductDAO.php';
    require_once './dao/ProductVariatieDAO.php';
    require_once './dao/FotoDAO.php';
    require_once './dao/KleurDAO.php';
    require_once './dao/WinkelwagenDAO.php';
    require_once './dao/ProductCategorieDAO.php';
    require_once './model/Product.php';
    require_once './model/ProductVariatie.php';
    require_once './model/Foto.php';
    require_once './model/Kleur.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Salt och Peppar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/winkelwagenicon.js"></script>
</head>

    
<body>
    <header>
        <div>
            <a id="toadmin" href=admin.php>To admin zone</a>
            <h1>Salt&amp;Peppar</h1>
            <div id="cart">
                <div class="dropdown">
                    
                    <?php include './winkelwagenpreview.php' ?>
                    
                    </div>
                <div class="amount"><?php echo $aantalItems?></div>
                <a href=winkelwagen.php class="overlay" title="<?php if($aantalItems >0) {echo $aantalItems . " items in cart";} else {echo "No items in shopping cart";}?>">Shopping cart</a>
            </div>
        </div>
        <img src="img/banner.jpg">
    </header>
    <main class="nocontainer">
        <div class="sidebar">
            <h3>Edit Filters</h3>
            
            <form id="applyFilters" action="index.php#productlist" method ="get">
                <div class="filter">
                    <h4>Product categories</h4>
                    <?php
                    $productCategories = ProductCategorieDAO::getProductCategorieen();
                    foreach($productCategories as $productCategorie) {
                    ?>
                        <label><input type="checkbox" name="productCategorieIds[]" value="<?php echo $productCategorie->getProductCategorieId()?>" 
                            <?php /*if(!isFormulierIngediend() || in_array($productCategorie->getProductCategorieId(), $_GET['productCategorieIds'])) {*/echo "checked";/*}*/?>>
                            <?php echo ucwords($productCategorie->getNaam())?></label>
                    <?php
                    }
                    ?>
                </div>
                <div class="filter slider">
                    <h4>Price range:</h4>
                    <div id="start-min-prijsInclBtw"><?php /*if(isFormulierIngediend()) { echo $_GET['min-prijsInclBtw']; } else {*/ echo "0";/*}*/ ?></div>
                    <div id="start-max-prijsInclBtw"><?php /*if(isFormulierIngediend()) { echo $_GET['max-prijsInclBtw']; } else {*/ echo "200";/*}*/ ?></div>
                    <span>€</span><input type="text" name="min-prijsInclBtw" id="min-prijsInclBtw" readonly> <span>-</span>
                    <span>€</span><input type="text" name="max-prijsInclBtw" id="max-prijsInclBtw" readonly>
                    <div id="slider-range-price"></div>
                </div>
                <div class="filter colors">
                    <h4>Colors</h4>
                    <?php
                    $kleuren = KleurDAO::getKleuren();
                    foreach($kleuren as $kleur) {
                    ?>
                        <label title="<?php echo $kleur->getNaam()?>" style="background-color: <?php echo $kleur->getKleurcode()?>">
                            <input type="checkbox" name="kleurIds[]" value="<?php echo $kleur->getKleurId()?>" 
                            <?php /*if(!isFormulierIngediend() || in_array($kleur->getKleurId(), $_GET['kleurIds'])) {*/echo "checked";/*}*/?>>
                        </label>
                    <?php
                    }
                    ?>
                </div>
                <input type="hidden" name="postcheck" value="true"/>
                <input type="submit" class="button inverted" value="Apply filters">
            </form>
        </div>
        <div class="productsection">
            <ul class="products cf" id="productlist">
                <?php include './get_productenAsListItems.php' ?>
            </ul>
        </div>
    </main>      

</body>
</html>