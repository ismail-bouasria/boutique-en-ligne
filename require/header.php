<?php
require_once("../Categorie.php");
require_once("../Bdd.php");
$bdd = new Bdd();
$categorie = new Categorie();
$lesCategoriesNavbar = $categorie->getLesCategories();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="../assets/public/style/bootstrap.min.css"> <!-- Inclure le fichier css prédefinie par bootstrap -->
    <link rel="stylesheet" href="../assets/public/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"> <!-- Importer la bibliothèque d'icones -->
</head>

<body>
    <header>
        <nav>
            <!--  barre de recherche -->
            <form action="" method="post">
                <input type="text" name="produits">
                <input type="submit" name="recherche" value="Rechercher">
                <?php
                if (isset($_POST['recherche']) && !empty($_POST['produits'])) {
                    $recherche = $_POST['produits'];
                    $query = "SELECT * FROM produits WHERE nom LIKE ? ORDER BY id DESC";
                    $produit = $bdd->bdd->prepare($query);
                    $produit->execute(array('%' . $recherche . '%'));
                }

                ?>
            </form>

            <ul>
                <li class="top"><a href="../index.php"> Accueil </a> </li>
                <li class="deroulant top"><a href="#">Nos produits &ensp;</a>
                    <ul class="sous">
                        <?php foreach ($lesCategoriesNavbar as $uneCategorie) : ?>
                            <li><a href=""><?= $uneCategorie["nom"] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <li><img src="../assets/img/nwfe-logo.png" width=80% alt=""></li>

                <li class="deroulant top"><a href="#">Mon compte &ensp;</a>
                    <ul class="sous">
                        <?php if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) : ?>
                            <li><a href="../php/authentification.php">Inscription/connexion</a></li>
                        <?php else : ?>
                            <li><a href="../php/profil.php"> profil</a></li>
                        <?php endif; ?>
                    </ul>

                </li>
                <?php if (isset($_SESSION["utilisateur"]) &&  $_SESSION["utilisateur"]["droit"] == "Administrateur") : ?>

                    <li class="deroulant top"><a href="#">Administrateur</a>
                        <ul class="sous">


                            <li><a href="../php/listeCategorie.php">Categorie</a></li>
                            <li><a href="../php/listeProduit.php">Produit</a></li>
                        </ul>

                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION["utilisateur"]) && $_SESSION["utilisateur"]["droit"] != "Administrateur") : ?>
                    <li class="top">
                        <?php echo $_SESSION["utilisateur"]["login"]; ?>
                    </li>
                <?php endif; ?>

                <li class="top">
                    <div id="panier">
                        <div id="bullePanier">
                            <p>0</p>
                        </div><a href="#">Panier</a><img id="imgPanier" src="../assets/img/panier.png" width="15%" alt="">
                    </div>
                </li>
            </ul>

        </nav>

    </header>