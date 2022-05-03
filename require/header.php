<?php
require_once("../Categorie.php");
require_once("../Produit.php");
require_once("../Bdd.php");



$produit = new Produit();
$categorie = new Categorie();
$lesCategoriesNavbar = $categorie->getLesCategories();

$lesProduitsEnPanier = [];
$quantiteEnPanier = 0;
$commandeTotalEnPanier = 0;

if (isset($_SESSION["panier"])) {
    foreach ($_SESSION["panier"] as $idProduit) {
        $unProduit = $produit->getUnProduit($idProduit);

        if (!array_key_exists($idProduit, $lesProduitsEnPanier)) {
            $lesProduitsEnPanier[$idProduit] = ["produit" => $unProduit, "quantite" => 1, "prixTotal" => number_format($unProduit["prix"], 2, '.', '')];
        } else {
            $lesProduitsEnPanier[$idProduit]["quantite"] += 1;
            $prixTotal = $unProduit["prix"] * $lesProduitsEnPanier[$idProduit]["quantite"];
            $prixTotalFormate = number_format($prixTotal, 2, '.', '');

            $lesProduitsEnPanier[$idProduit]["prixTotal"] = $prixTotalFormate;
        }
        $quantiteEnPanier++;
        $commandeTotalEnPanier += $unProduit["prix"];
    }
    $commandeTotalEnPanier = number_format($commandeTotalEnPanier, 2, '.', '');
}


if (isset($_REQUEST['produits'])) {
    $recherche = $_REQUEST['produits'];
    header("Location: lesProduits.php?action=recherche&nom=" . $recherche);
}



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
            <form method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="produits" placeholder="Rechercher un produit" required>
                </div>
            </form>
            <ul class="flex col justify-content-around">
                <li class="top"><a href="../index.php"> Accueil </a> </li>
                <li class="deroulant top"><a href="#">Nos produits &ensp;</a>
                    <ul class="sous">
                        <?php foreach ($lesCategoriesNavbar as $uneCategorie) : ?>
                            <li><a href="lesProduits.php?idCategorie=<?= $uneCategorie["id"] ?>"><?= $uneCategorie["nom"] ?></a></li>
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
                            <li><a href="../php/listeSousCategorie.php">Sous Categorie</a></li>
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
                            <p><?= isset($quantiteEnPanier) ? $quantiteEnPanier : 0 ?></p>
                        </div><a href="panier.php">Panier</a><img id="imgPanier" src="../assets/img/panier.png" width="15%" alt="">
                    </div>
                </li>
            </ul>

        </nav>

    </header>