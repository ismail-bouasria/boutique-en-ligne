<?php

session_start();
require '../classes/Produit.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/boutique.css">
    <title>Panier</title>
</head>
<body>
<?php
require "../require/header.php";
?>
<main>
<div class="container mt-5 p-3 rounded cart">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center fw-bold">Panier</h2>
            <div class="mt-3 p-2 items rounded">
                <div class="d-flex col justify-content-between text-center">
                    <div class="col col-md-1 text-start">
                        Image
                    </div>
                    <div class="col col-md-3">
                        Produit
                    </div>
                    <div class="col col-md-1">
                        Quantité
                    </div>
                    <div class="col col-md-1 text-end">
                        Prix total
                    </div>
                </div>
            </div>
            <?php if (isset(
                $lesProduitsEnPanier
            )) : ?>
                <?php foreach ($lesProduitsEnPanier as $unProduit) : ?>
                    <div class="mt-3 p-2 items rounded">
                        <div class="d-flex col justify-content-between text-center">
                            <div>
                                <img class="rounded" src="../assets/img/sandwith.jpg" width="100">
                            </div>
                            <div class="d-flex flex-column">
                                <span class="fw-bold">
                                    <?= $unProduit["produit"]["nom"] ?>
                                </span>
                                <span>
                                    Prix unitaire <?= number_format($unProduit["produit"]["prix"], 2, '.', '') ?>€
                                </span>
                            </div>
                            <div>
                                <span>
                                    <?= $unProduit["quantite"] ?>
                                </span>
                            </div>
                            <div>
                                <span class="font-weight-bold">
                                    <?= $unProduit["prixTotal"] . "€" ?>
                                </span><i class="fa fa-trash-o ml-3 text-black-50"></i>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</main>
<?php
require "../require/footer.php";
?>

</body>
</html>




