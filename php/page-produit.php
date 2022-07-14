<?php
session_start();

require '../classes/Produit.php';
require '../classes/Souscategorie.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';


$produit = new Produit('');
$categorie = new SousCategorie('');

$_GET['produit'] = intval(strip_tags($_GET['produit']));
$infosProduit = $produit->getAllProductsByIDSous($_GET['produit']);
$_SESSION['stockproduit'] = $infosProduit['stock'];
$_SESSION['idproduit'] = $infosProduit['id'];


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/boutique.css">
    <link rel="stylesheet" href="../assets/css/page-produit.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/cssboot/bootstrap.css">
    <script src="../js/bootstrap.js"></script>
    <script src="../js/produit.js"></script>
    <title><?php echo $infosProduit['nom']; ?></title>
     

</head>


<body>
    <?php
    require '../require/header.php';

    if (!empty($_GET)) { ?>
        <main>

            <div id="info-produit">
                <article id="card-produit">

                    <section>
                        <h1><?php echo $infosProduit['nom']; ?></h1>
                    </section>
                    <img src="<?php echo $infosProduit['image']; ?>" alt="<?php echo $infosProduit['nom']; ?>">

                </article>

                <div id="card-produit2">

                    <h2>Description</h2>
                    <p> <?php echo $infosProduit['description']; ?></p>

                    <h2> Prix </h2>
                    <p><?php echo $infosProduit['prix']; ?>€</p>

                    <h2> Stock </h2>
                    <p><?php echo $_SESSION['stockproduit']; ?> </p>
                    <?php if ($_SESSION['stockproduit'] == 0) { ?>
                        <div>
                            <a class="button-5" style="background: #f7ccad;">Rupture du produit </a>
                        </div>
                    <?php } else { ?>
                        <form action="../traitements/formulaire-ajouter-panier.php" method="post">

                            <label> Quantité</label>
                            <div>
                                <input type="number" id="quantite" name="quantite" min="1" value="1" max="<?php echo $_SESSION['stockproduit']; ?>" class="form-control" colisage="1">
                            </div>
                            <div>
                                <button class="button-5" type="submit" name="panier"> Ajouter au panier </button>
                            </div>

                        </form>
                    <?php  } ?>



                </div>



            </div>


            <div id="categorie">
                <section>
                    <h2><b>Une autre envie ? Craquez pour notre selection !</b></h2>
                </section>
                <div id="flexcat">
                <?php
                        $getProduit = $produit->getAllProducts();

                        foreach ($getProduit as $valueP) { ?>
                    <div id="cat-produits">
                        
                            <div class="img-container">
                                <img src="<?php echo $valueP['image']; ?>" alt="<?php echo $valueP['nom']; ?>" />
                                <div class="img-content">
                                    <h1> <?php echo $valueP['nom']; ?></h1>
                                    <p> <?php echo $valueP['description']; ?></p>
                                    <h1> Prix : <span> <?php echo $valueP['prix']; ?>€</span> </h1>
                                    <a href="page-produit.php?produit=<?php echo $valueP['id']; ?>" class="btn btn-primary" target="blank"> Commander !</a>
                                </div>
                            </div>
                        
                    </div>
                    <?php  } ?>
                </div>
            </div>

        <?php  } else {
        header('location:nos-produits.php');
    } ?>
        </main>

        <?php
        require '../require/footer.php';
        ?>
</body>

</html>