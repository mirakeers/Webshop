<?php
    require_once './model/ProductCategorie.php';
    require_once './dao/ProductCategorieDAO.php';
    include_once './validatiebibliotheek.php';
    $categorieNaamVal = "";
    $categorieNaamErr = "";
    $toonFormulier = true;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Salt och Peppar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="icon" href="favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/discard.js"></script>
</head>
<body class="admin">
    <header>
        <div>
            <a id="toadmin" href=index.php>To webshop</a>
            <h1 class="col-lg-8 col-lg-offset-2">Salt&amp;Peppar | admin zone</h1>
        </div>
    </header>
    <main>
        <div class="container cf text-center">
            
    <?php
    if (isFormulierIngediend()) {
        $categorieNaamErr = errRequiredVeld("categorieNaam");
        if (isFormulierValid()) {
            $toonFormulier = false;
            $newProductCategorie = new ProductCategorie(0, $_POST["categorieNaam"]);
            ProductCategorieDAO::insert($newProductCategorie);
        ?>
            <p class="text-center">The category "<?php echo $newProductCategorie->getNaam();?>" was succesfully added!</p>
        <?php
        }else {
            $categorieNaamVal = getVeldWaarde("categorieNaam");
        }
    }?>
        <a class="button inverted btn-mb" href=admin.php>&larr; Back to admin page</a>
    <?php
    if($toonFormulier) {
    ?>                  
            <h2 class="text-center">Add new category</h2>
            <form action="categorietoevoegen.php " method ="post">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <mark><?php echo $categorieNaamErr;?></mark>
                        <label for="categorieNaam">Category name</label>
                        <input type="text" name="categorieNaam" value="<?php echo $categorieNaamVal; ?>">
                    </div>
                </div>
                <div class="row" style="margin-top: 3em;">
                    <div class="col-lg-12 text-center">
                        <a href=# class="discard button inverted">Discard</a>
                        <input type="hidden" name="postcheck" value="true"/>
                        <input type="submit" class="button inverted" style="margin-left: 20px;" value="Add category">
                    </div>
                </div>
            </form>
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
    function isFormulierValid() {
        global $categorieNaamErr;
        if (empty($categorieNaamErr)) {
            //Formulier is valid
            return true;
        } else {
            return false;
        }
    }
?>