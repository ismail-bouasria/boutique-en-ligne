<?php

session_start();
require("../Commande.php");
require("../User.php");

include("../require/header.php");


$userPaiement = new User();
/**
 * Si l'utilisateur n'existe pas dans la session
 */
if (!isset($_SESSION["utilisateur"])) {
  header("Location: authentification.php");
}

/**
 * Si l'utilisateur existe dans la session 
 * et que son adresse n'est pas remplie
 */
if (isset($_SESSION["utilisateur"]) && empty($_SESSION["utilisateur"]["adresse"])) {
  $unUtilisateur = $userPaiement->getUnUtilisateurParLogin($_SESSION["utilisateur"]["login"]);

  if (empty($unUtilisateur["adresse"])) {
    header("Location: modifierProfil.php");
  }

  $_SESSION["utilisateur"] = $unUtilisateur;
  header("Location: paiement.php");
}

/**
 * 
 */

if (isset($_REQUEST["formValiderPaiement"]) && !empty($_SESSION["utilisateur"]["adresse"])) {
  $commande = new Commande();
  $numeroDeCommande = "";

  for ($i = 0; $i < 10; $i++) {
    $numeroDeCommande .= strval(rand(0, 9));
  }

  $uneCommande = $commande->ajouterCommande($numeroDeCommande);
  foreach ($lesProduitsEnPanier as $unProduit) {

    $idProduit = $unProduit["produit"]["id"];
    $idUtilisateur = $_SESSION["utilisateur"]["id"];
    $idCommande = $uneCommande["id"];
    $quantite = $unProduit["quantite"];

    $commande->ajouterUneLigneCommande($idProduit, $idUtilisateur, $idCommande, $quantite);
  }

  header("Location: confirmationCommande.php?numeroCommande=" . $numeroDeCommande);
}

?>

<div class="container">
  <form class="form-horizontal" role="form">
    <fieldset>
      <legend>Paiement</legend>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="nomDetenteur">Nom du détenteur</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="nomDetenteur" placeholder="Numero du détenteur" maxlength="16">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="numeroCarte">Numero de carte *</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="numeroCarte" placeholder="Numero de carte">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="expiry-month">Date d'expiration</label>
        <div class="col-sm-9">
          <div class="row">
            <div class="col-xs-3">
              <select class="form-control col-sm-2" name="expiry-month">
                <?php for ($i = 1; $i <= 12; $i++) : ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <div class="col-xs-3">
              <select class="form-control" name="expiry-year">
                <?php for ($i = 2018; $i <= 2028; $i++) : ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="cvv">CVV</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="cvv" placeholder="Code de securité CVV">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" class="btn btn-success" name="formValiderPaiement">Proceder au paiement</button>
        </div>
      </div>
    </fieldset>
  </form>
</div>