<?php
session_start();
require '../classes/Produit.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
$produit = new Produit();
$panier = new Panier('');
$_SESSION['erreur'] = '';
$stock = $_SESSION['stockproduit'];
$id = $_SESSION['idproduit'];


if (isset($_POST['panier'])) {
    $quantite = intval($_POST['quantite']);
   
    $idUser = $_SESSION['id'];

    if (!empty($quantite)) {
        if (is_int($quantite)) {
            if ($quantite <= $stock) {
                $exist = $panier->getProduitPanier($id,$idUser);

                var_dump($exist);
                 if (empty($exist)) {
                    $addPanier = $panier->addPanier($quantite,$id,$idUser);
                 }else {
                      $addMore = $panier->addOneMoreProduit($quantite,$id,$idUser);
                 }
                

                header('Location: ../php/panier.php');

                $_SESSION['succes'] = '<h1> Ajout du produit !</h1> <p> Votre produit à correctement était ajouté. </p>';
            } else {
                header('Location: ../php/page-produit.?produit=' . $id . 'php?err=nostock');
                $_SESSION['erreur'] = '<h1> Ajout du produit Impossible !</h1> <p> Utiliser un nombre entier. </p>';
            }
        } else {
            header('Location: ../php/page-produit.php?err=nobint');
            $_SESSION['erreur'] = '<h1> Ajout du produit Impossible !</h1> <p> Utiliser un nombre entier. </p>';
        }
    } else {
        header('Location: ../php/page-produit.php?err=quantite');
        $_SESSION['erreur'] = '<h1> Ajout du produit Impossible !</h1> <p> La quantité du produit est invalide. </p>';
    }
}
