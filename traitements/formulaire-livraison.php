<?php
session_start();
$_SESSION['erreur'] = '';
require '../classes/Bdd.php';
require '../classes/Adresse.php';
require '../classes/Commandes.php';
$commande = new Commandes ();
$Adress = New Adresse();


if (isset($_POST['click'])) {

    $idAdress = 1;
    $idUser= $_SESSION['id'];
    $commande->UpdateAdressCommande($idAdress,$idUser);
    
}elseif (isset($_POST['place'])) {

    $idAdress = 2;
    $idUser= $_SESSION['id'];
    $commande->UpdateAdressCommande($idAdress,$idUser);

}elseif (isset($_POST['livraison'])) {
    
    $idUser= $_SESSION['id'];
    $idAdress = $Adress->selectIdAdressByUser($idUser);
   
    $commande->UpdateAdressCommande($idAdress,$idUser);
}

?>