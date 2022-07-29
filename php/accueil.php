<?php
session_start();
require '../classes/Produit.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="../assets/css/boutique.css">
    <link rel="stylesheet" href="../assets/css/categorie-produit.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/cssboot/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/search.js"></script>
    <script src="https://kit.fontawesome.com/53bdaa6800.js" crossorigin="anonymous"></script>
</head>

<body class="w-full h-full">
    <?php
    require '../require/header.php';
    ?>
    <main>
        <section id="enCeMoment">
            <img class="responsimg" src="../assets/img/Breads-poulet-pane.jpg" width=100% alt="">
            <h1 id="text">EN CE MOMENT</h1>
            <h1 id="text2">LE BREAD</h1>
            <h1 id="text3"> CROUSTI POULET</h1>
            <a href="http://localhost:8888/boutique-en-ligne/php/page-produit.php?produit=6"><button>JE COMMANDE !</button></a>

        </section>

        <section id="bienvenue">
            <h1>Bienvenue chez <span id="color1"> No Wasting</span> <span id="color2">For Eat!</span> </h1>
        </section>

        <section id="presentation">
            <div class="responsimg2"><img id="imgPresentation" src="../assets/img/restaurant.jpg" width="100%" alt="No Wasting for eat"></div>
            <article>
                <h1>CONCEPT INÉDIT !</h1>
                <p> No Wasting For Eat, propose aux clients des produits de qualités issues de l'agriculture Bio et d'un circuit de distribution cours
                    des producteurs locaux avec un concept novateur réduire le plus possible le gaspillage alimentaire avec des stocks limité de produit à consommer pendant ses heures d’ouvertures.
                </p>
                <p>
                    <span>Premier arrivé, Premier servi !</span>
                </p>
            </article>
        </section>

        <div id="informations">
            <div id="localisation">
                <div><img src="../assets/img/localisation.png" width="20%" alt="">
                    <h1> Où nous trouver ? </h1>
                </div>

                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2903.45601176587!2d5.36793005106479!3d43.30471257903232!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c9c13ddc0211b9%3A0xd1642ae4b32c4bc4!2sEcole%20La%20Plateforme%2C%20le%20Campus%20M%C3%A9diterran%C3%A9en%20du%20Num%C3%A9rique!5e0!3m2!1sfr!2sfr!4v1649760523909!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div id="horaires">
                <div> <img src="../assets/img/horraire.png" width="15%" alt="">
                    <h1> Nos horaires d'ouvertures ? </h1>
                </div>
                <div>
                    <h2>DU LUNDI AU SAMEDI </h2>

                    <h2>12h – 14h30 & 19h – 22h</h2>
                </div>
            </div>
        </div>

        <div class="contenairProduit">
            <div id="categorie">
                <section>
                    <h1>
                        Nos produits phares !
                    </h1>
                </section>
                <div class="flexy">
                    <?php
                    $produit = new Produit();
                    $getProduit = $produit->famousProduct();

                    foreach ($getProduit as $valueP) { ?>
                        <div id="cat-produits">

                            <div class="img-container">
                                <img src="<?php echo $valueP['image']; ?>" alt="<?php echo $valueP['nom']; ?>" />
                                <div class="img-content">
                                    <h1> <?php echo $valueP['nom']; ?></h1>
                                    <p> <?php echo $valueP['description']; ?></p>
                                    <h1> Prix : <span> <?php echo $valueP['prix']; ?>€</span> </h1>
                                    <a href="page-produit.php?produit=<?php echo $valueP['id']; ?>" class="btn btn-primary"> Commander !</a>
                                </div>
                            </div>

                        </div>
                    <?php  } ?>
                </div>
            </div>
        </div>

        <div class="contenairProduit">
            <div id="categorie">
                <section>
                    <h1>
                        Nos dernières recettes !
                    </h1>
                </section>
                <div class="flexy">
                    <?php
                    $produit = new Produit();
                    $getProduit = $produit->lastProduct();

                    foreach ($getProduit as $valueP) { ?>
                        <div id="cat-produits">

                            <div class="img-container">
                                <img src="<?php echo $valueP['image']; ?>" alt="<?php echo $valueP['nom']; ?>" />
                                <div class="img-content">
                                    <h1> <?php echo $valueP['nom']; ?></h1>
                                    <p> <?php echo $valueP['description']; ?></p>
                                    <h1> Prix : <span> <?php echo $valueP['prix']; ?>€</span> </h1>
                                    <a href="page-produit.php?produit=<?php echo $valueP['id']; ?>" class="btn btn-primary"> Commander !</a>
                                </div>
                            </div>

                        </div>
                    <?php  } ?>
                </div>
            </div>
        </div>
    </main>
    <?php
    require '../require/footer.php';
    ?>
</body>

</html>