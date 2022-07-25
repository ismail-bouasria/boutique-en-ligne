<?php 
session_start();
require '../classes/Bdd.php';
require '../classes/Panier.php';

$panier = new Panier();
$idUser = $_SESSION['id'];
$contentPanier = $panier->showProduitPanier($idUser);

if (isset($_POST['commander'])) {

    $stock = $panier->countstock($idUser, $value['id']);
    if (!empty($contentPanier)) {
        if ($_SESSION['rupture']== True ) {
            header("Location:../php/panier.php?err=emptyproduit.php");
            $_SESSION['erreur'] = '<h1> Impossible de passer la commande </h1> <p> Certains produits sont en rupture de stock. </p>';
        }else {
            header("Location:../php/mode-livraison.php");   
        }
    }else{
        header("Location:../php/panier.php?err=emptypanier.php");
            $_SESSION['erreur'] = '<h1> Impossible de passer la commande </h1> <p> Le panier est vide. </p>';
    }
   
    
}
