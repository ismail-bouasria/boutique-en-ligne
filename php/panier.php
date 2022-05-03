<?php
session_start();
require '../classes/Produit.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
$produit = new Produit();
$panier = new Panier('');


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/boutique.css">
    <link rel="stylesheet" href="../assets/css/panier.css">
    <link rel="stylesheet" href="../assets/css/page-produit.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../js/produit.js"></script>
    <title>Panier</title>

</head>


<body>
    <?php
    require '../require/header.php';
    if (!empty($_GET)) {
       
        $ids = array_keys($_SESSION['panier']);
        var_dump($ids);
        $ids2= implode(',',$ids);
        var_dump($ids2);
        $listeproduit = $produit->getAllProduitPanier($ids2);
        var_dump($produit->getAllProduitPanier($ids2));
    ?>


        <main>
          

            
                <div id="info-produit">
                    <div id="add-produit">
                        <section id="prix">
                            <h3><b>Total = 12,79€ TTC</b></h3>
                        </section>
                        <div id="infos">
                            <section>
                                <img id="image" src="../assets/img/Rectangle 131.png" alt="">
                            </section>
                            <section id="information">
                                <h4>Crousti Poulet</h4>
                                <p> Categorie : </p>
                                <p> Description : </p>
                                <p> Prix : </p>
                            </section>

                        </div>
                        <section>
                            <div id="boxquantite">
                                <p>Quantité : </p>
                                <button id="moins1">-</button>
                                <input type="number" class="number" id="quantite" name="quantite" required="required" min="1" value="1" max="<?php echo $infosProduit['stock']; ?>" class="form-control" colisage="1">
                                <button id="plus1">+</button>
                            </div>
                        </section>
                        <section id="supprimer">

                        </section>
                    <?php } else {
                    die(header('Location:panier.php?empty=paniervide'));
                } ?>

                    </div>

                    <div id="total-produit">



                    </div>



                </div>


                <div id="categorie">
                    <section>
                        <h2><b>Selection inspirée par nos client ? </b></h2>
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
                                        <a href="page-produit.php?produit= <?php echo $valueP['id']; ?>" class="btn btn-primary" target="blank"> Commander !</a>
                                    </div>
                                </div>

                            </div>
                        <?php  } ?>
                    </div>
                </div>

            
        </main>

        <?php
        require '../require/footer.php';
        ?>
</body>

</html>