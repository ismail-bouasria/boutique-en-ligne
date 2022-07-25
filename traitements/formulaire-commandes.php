<?php
session_start();
require '../classes/Bdd.php';
require '../classes/Commandes.php';
require '../classes/Panier.php';
$commande = new Commandes();

if (isset($_POST['commander'])) {
     
    $commande->createCommande($numero,$idUser,$idPanier);
}


?>


