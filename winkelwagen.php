<?php
    require_once './dao/ProductDAO.php';
    require_once './dao/ProductVariatieDAO.php';
    require_once './dao/FotoDAO.php';
    require_once './dao/KleurDAO.php';
    require_once './dao/WinkelwagenDAO.php';
    require_once './model/Product.php';
    require_once './model/ProductVariatie.php';
    require_once './model/Foto.php';
    require_once './model/Kleur.php';
    include_once './betaling/Ingenico.php';
    
    $items = WinkelwagenDAO::getWinkelwagenItems();
    $aantalItems = WinkelwagenDAO::getTotaalAantalItems();
    $totaalPrijsInclBtw = WinkelwagenDAO::getTotaalPrijsInclBtw();
    $totaalBtw = WinkelwagenDAO::getTotaalBtw();
    $totaalPrijsExclBtw = WinkelwagenDAO::getTotaalPrijsExclBtw();
    
    if (isFormulierIngediend()) {
        //WinkelwagenDAO::updateAantalItems($_POST["productVariatieId"], 0);
        //header("Location:winkelwagen.php");
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Salt och Peppar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/winkelwagen.js"></script>
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
    </header>
    <main>
        <div class="container cf">
            <?php
            if($aantalItems > 0) {
            ?>
            <div>
                <a class="button btn-mb" href=index.php>&larr; Back to overview</a>
            </div>
            <table class="cart">
                <thead>
                    <tr>
                        <th>Product item</th>
                        <th>Amount</th>
                        <th>PPU</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($items as $item) {
                            $product = $item->getProduct();
                            $productvariatie = $item->getProductVariatie();
                            $kleur = KleurDAO::getKleurById($productvariatie->getKleurId());
                            $fotoTypeProduct = FotoDAO::getFotoOfTypeProductByProductVariatieId($item->getProductVariatieId());
                        ?>
                            <tr data-productVariatieId="<?php echo $item->getProductVariatieId()?>">
                                <td>
                                    <img src="<?php echo $fotoTypeProduct->getLocatieFull()?>">
                                    <h3><a href="detail.php?productId=<?php echo $product->getProductId()?>"><?php echo $product->getNaam()?></a></h3>
                                    <div title="<?php echo $kleur->getNaam()?>"><div class="colordot" style="background-color: <?php echo $kleur->getKleurcode()?>"></div><?php echo ucwords($kleur->getNaam())?></div>
                                    <form class="deleteItem" action="winkelwagen.php" method ="post">
                                        <input type="hidden" name="postcheck" value="true"/>
                                        <input type="hidden" name="productVariatieId" value="<?php echo $item->getProductVariatieId()?>"/>
                                        <input type="submit" class="button" value="Delete Item">
                                    </form>
                                </td>
                                <td>
                                    <div class="counter">
                                        <a class="less" href=#>-</a>
                                        <div class="number"><?php echo $item->getAantal()?></div>
                                        <a class="more" href=#>+</a>
                                    </div>
                                </td>
                                <td>
                                    <h4 class="price-small">€<span class="ppu"><?php echo number_format($product->getPrijsInclBtw(), 2)?></span></h4>
                                    <h5>€<span class="ppu"><?php echo number_format($product->getPrijsExclBtw(), 2)?></span> excl. BTW</h5>
                                </td>
                                <td class="totaalprijs">
                                    <h4 class="price-small">€<?php echo number_format($item->getTotaalPrijsInclBtw(), 2)?></h4>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            <h4 class="price-small"><span class="amount"><?php echo $aantalItems?></span> article<?php if($aantalItems != 1){echo "s";}?>:</h4>
                            <h4 class="price-small">BTW:</h4>
                            <h4 class="price-small"><strong>Total amount:</strong></h4>
                        </td>
                        <td colspan="1">
                            <h4 class="price-small winkelwagenTotaalExclBtw">€<?php echo number_format($totaalPrijsExclBtw, 2)?></h4>
                            <h4 class="price-small winkelwagenTotaalBtw">€<?php echo number_format($totaalBtw, 2)?></h4>
                            <h4 class="price-small winkelwagenTotaalInclBtw"><strong>€<?php echo number_format($totaalPrijsInclBtw, 2)?></strong></h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <p class="msg-payment-not-active">Please refresh the page to proceed to payment...</p>
                             <?php
                                $mijnBetaling = Ingenico::genereerNieuweBetaling(round($totaalPrijsInclBtw * 100));
                                //Eventueel kan je hier nog eigenschappen van de betaling aanpassen        
                                //$mijnBetaling->setKlantEmail("emailadres");
                                $mijnBetaling->genereerBetalingsformulier();
                            ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <?php
            } else {
            ?>
            <div class="emptyshoppingbag">
                <img src="img/cart.svg">
                <h2>Your shopping bag is empty</h2>
                <p>There are no items yet in your shopping cart. Look for cool stuff in our store!</p>
                <a class="button btn-mb" href=index.php>&larr; To the shop</a>
            </div>
            <?php
            }
            ?>
        </div>
        
    </main>
        

</body>
</html>
<?php
    function isFormulierIngediend() {
        return isset($_POST['postcheck']);
    }
?>