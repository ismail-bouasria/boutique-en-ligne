<?php 
 session_start();
require '../classes/Bdd.php';
require '../classes/Commandes.php';
require '../classes/Produits.php';
require '../classes/Panier.php';

$commande = new Commandes();
$produits = new Produit();
$panier = new panier();


// CONDITION Du PAIEMENT
if (isset($_POST['payer'])) {

   $cardNumber = $_POST['numero'];
   $date = $_POST['date'];
   $cvc = $_POST['cvc'];
   $idUser = intval($_SESSION['id']);

    if (!empty($number) && !empty($date) && !empty($cvc)) {
        $commande->finishCommande($idUser);
    } else {
        header('Location: ../php/paiement.php?err=noinfo');
        $_SESSION['erreur'] = '<h1> Paiement Impossible !</h1> <p> Remplir tout les champs. </p>';
    }
} ?>


?>