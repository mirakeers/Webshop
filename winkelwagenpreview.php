<?php
    require_once './dao/ProductDAO.php';
    require_once './dao/ProductVariatieDAO.php';
    require_once './dao/WinkelwagenDAO.php';
    require_once './model/Product.php';
    require_once './model/ProductVariatie.php';
    require_once './model/WinkelwagenItem.php';
    
    $items = WinkelwagenDAO::getWinkelwagenItems();
    $aantalItems = WinkelwagenDAO::getTotaalAantalItems();
    $totaalPrijsInclBtw = WinkelwagenDAO::getTotaalPrijsInclBtw();
    $totaalBtw = WinkelwagenDAO::getTotaalBtw();
    $totaalPrijsExclBtw = WinkelwagenDAO::getTotaalPrijsExclBtw();

?>

<div class="close"><a href=# onclick="hideInfo(event)">Close</a></div>
<h3>My Shopping cart</h3>
<ul class="items" data-aantal="<?php echo $aantalItems?>">
    <?php foreach ($items as $item) { ?>
        <li class="cf">
            <p class="name"><?php echo $item->getAantal(); ?>x <a href="detail.php?productId=<?php echo $item->getProductVariatie()->getProductId()?>"><?php echo $item->getProduct()->getNaam();?></a></p>
            <p class="price">€<?php echo number_format($item->getTotaalPrijsInclBtw(), 2)?></p>
        </li>
    <?php } ?>
</ul>
<div class="total">
    <p class="name">Total amount: </p>
    <p class="price">€<?php echo number_format($totaalPrijsInclBtw, 2)?></p>
</div>
<a class="button" href=winkelwagen.php onclick="hideInfo(event)">View Shopping Cart</a>
                