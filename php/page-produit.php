<?php
session_start();

require '../classes/Produit.php';
require '../classes/Souscategorie.php';
require '../classes/Categorie.php';


$produit = new Produit('');
$categorie = new SousCategorie('');

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
    <script src="../js/produit.js"></script>
    <title>Produit</title>

</head>


<body>
    <?php
    require '../require/header.php';

    if (!empty($_GET)) { ?>
        <main>

            <div id="info-produit">
                <article id="card-produit">
                    <?php
                    $id = intval(strip_tags($_GET['produit']))

                    foreach ($produit->getAllProductsByID($id) as $value) {  ?>
                    
                    <section>
                        <h1><?php echo $value['nom']?></h1>
                    </section>
                    <img src="<?php echo $value['image']?>" alt="<?php echo $value['nom']?>">
                </article>

                <div id="card-produit2">
                    <h2>Description</h2>
                    <p> poulet croustillant</p>

                    <h2> Prix </h2>
                    <p>55€</p>

                    <h2> Stock </h2>
                    <p>4</p>

                    <form action="">
                        <label> Quantité</label>
                        <div>
                            <button id="moins">-</button>
                            <input type="number" id="quantite" name="quantite" required="required" min="1" value="1" class="form-control" colisage="1">
                            <button id="plus">+</button>
                        </div>
                        <div>

                            <button class="button-5" type="submit" name="panier"> Ajouter au panier </button>
                    </form>
                    <a class="button-5" style="background: #f7ccad;" href="/atelier-cribili/views/payement.html">Acheter directement</a>
                </div>
            </div>
    </div>

            <div id="categorie">
                <section>
                    <h2><b>Une autre envie ? Craquez pour notre selection !</b></h2>
                </section>

                <?php
                $getProduit = $produit->getAllProducts();
                if (!empty($getProduit)) {
                    foreach ($getProduit as $valueP) { ?>

                        <div id="cat-produits">
                            <div class="img-container">
                                <img src="<?php echo $valueP['image']; ?>" alt="<?php echo $valueP['nom']; ?>" />
                                <div class="img-content">
                                    <h1> <?php echo $valueP['nom']; ?></h1>
                                    <p> <?php echo $valueP['description']; ?></p>
                                    <h1> Prix : <span> <?php echo $valueP['prix']; ?>€</span> </h1>
                                    <a href="page-produit.php?produit= <?php echo $valueP['prix']; ?>" class="btn btn-primary" target="blank"> Commander !</a>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>
                <?php  } else { ?>
                    <section id="no-produits">
                        <h3>Pas de produit pour le moment</h3>
                    </section>;
                <?php } ?>
            </div>
        </main>
    <?php  } else {
        header('location:nos-produits.php');
    } ?>


    <?php
    require '../require/footer.php';
    ?>
</body>

</html>