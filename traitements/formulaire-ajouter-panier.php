<?php
session_start();
require '../classes/Produit.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
require '../classes/Historiques-panier.php';
require '../classes/Commandes.php';

// instanciation des classes à utilisés 

$produit = new Produit();
$panier = new Panier('');
$historique = new HistoriquePanier();
$commande = new Commandes();

// Autres variables utiles

$_SESSION['erreur'] = '';
$stock = $_SESSION['stockproduit'];
$id = $_SESSION['idproduit'];


if (isset($_POST['panier'])) {

    $quantite = intval($_POST['quantite']);
    $idUser = intval($_SESSION['id']);
    $commandeExist = $commande->commandeExist($idUser);


    if (empty($commandeExist)) {
        $numero = uniqid();

        $commande->createCommande($numero,$idUser);
    }
        if (!empty($quantite)) {
            if (is_int($quantite)) {
                if ($quantite <= $stock) {
    
                    $exist = $panier->getProduitPanier($id,$idUser);
                    $existHistorique = $historique->getProduitHistorique($id,$idUser);
                    $idCommande = $commande->getNumero($idUser);
                    
    
                    if (empty($exist)) {
                        $addPanier = $panier->addPanier($quantite,$id,$idUser);
                     }else {
                          $addMore = $panier->addOneMoreProduit($quantite,$id,$idUser);
                     }


                     if (empty($existHistorique)) {
                        $addhistorique = $historique->addHistoriquePanier($quantite,$id,$idCommande);
                     }else {
                          $addMoreHistorique = $historique->addOneMoreHistorique($quantite,$id,$idCommande);
                     }
                    
    
                    header('Location: ../php/panier.php');
    
                    $_SESSION['succes'] = '<h1> Ajout du produit !</h1> <p> Votre produit à correctement était ajouté. </p>';
                } else {
                    header('Location: ../php/page-produit.?produit=' . $id . 'php?err=nostock');
                    $_SESSION['erreur'] = "<h1> Ajout du produit Impossible !</h1> <p> Le produit n'est plus disponible. </p>";
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
