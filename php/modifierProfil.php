<?php
session_start();
require("../User.php");
$user = new User();

if (isset($_REQUEST["formAjouter"])) {
    $nom = $_REQUEST["nom"];
    $prenom = $_REQUEST["prenom"];
    $telephone = $_REQUEST["telephone"];
    $adresse = $_REQUEST["adresse"] . ", " . $_REQUEST["codePostal"] . " " . $_REQUEST["ville"];
    $user->ajouterAdresse($nom, $prenom, $adresse, $telephone);
}
if (isset($_REQUEST["formModifier"])) {
    $login = $_REQUEST["login"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $user->Update($login, $password, $email);
}
if (isset($_REQUEST["formModifierPuisPaiement"])) {
    $login = $_REQUEST["login"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $user->Update($login, $password, $email);

    header("Location: paiement.php");
}
var_dump($_SERVER);
if (
    isset($_SESSION["utilisateur"])
    && empty($_SESSION["utilisateur"]["adresse"])
    && end(explode($_SERVER["HTTP_REFERER"], "/")) === "paiement.php"
) {
    $enAttenteDePaiement = true;
}
include("../require/header.php"); ?>
<div class="container row justify-content-center mx-auto">

    <form class="col-md-6" method="post" action="">

        <fieldset class="container row mt-1 h-100  border border-dark border-2 p-1 rounded">
            <h3 class="no">Modifier vos informations</h2>

                <div class="form-group col-md-7">
                    <label class="form-label" for="login">Identifiant *</label>
                    <input type="text" class="form-control" name="identifiant" placeholder="Entrez un identifiant">
                </div>
                <div class="form-group col-md-7">
                    <label class="form-label" for="email">Email *</label>
                    <input type="email" class="form-control" name="email" placeholder="Entrez votre email">
                </div>
                <div class="form-group col-md-7">
                    <label class="form-label" for="motDePasse">Mot de passe *</label>
                    <input type="password" class="form-control" name="motDePasse" placeholder="Entrez un mot de passe">
                </div>
                <div class="form-group col-md-7">
                    <label class="form-label" for="confirmerMotDePasse">Confirmer votre mot de passe *</label>
                    <input type="password" class="form-control" name="confirmerMotDePasse" placeholder="Confirmer le Mot de passe">
                </div>
                <div class="row form-group justify-content-center">
                    <button type="submit" class="rounded-pill p-2 btn btn-success mt-5 mb-3 col-md-10" name="<?= $enAttenteDePaiement ? "formModifierPuisPaiement" : "formModifier" ?>">
                        Modifier
                    </button>
                </div>

        </fieldset>

    </form>

    <form class="col-md-6 " method="post" action="">
        <fieldset class="container h-100 row mt-1 border border-dark border-2 p-1 rounded">
            <h3 class="no">Ajouter adresse</h2>
                <div class="form-group col-md-6">
                    <label class="form-label" for="nom">Nom*</label>
                    <input type="text" class="form-control" name="nom" placeholder="Entrez un nom">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="prenom">Prenom *</label>
                    <input type="text" class="form-control" name="prenom" placeholder="Entrez un prenom">
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label" for="codePostal">code postal *</label>
                    <input type="text" class="form-control" name="codePostal" maxlength="5" placeholder="Entrez un code postal">
                </div>
                <div class="form-group col-md-8">
                    <label class="form-label" for="ville">ville *</label>
                    <input type="text" class="form-control" name="ville" placeholder="Entrez une ville">
                </div>
                <div class="form-group col-md-12">
                    <label class="form-label" for="adresse">adresse *</label>
                    <input type="text" class="form-control" name="adresse" placeholder="Entrez une adresse">
                </div>
                <div class="form-group col-md-12">
                    <label class="form-label" for="telephone">telephone *</label>
                    <input type="text" class="form-control" name="telephone" maxlength="10" placeholder="Entrez un telephone ">
                </div>

                <div class="row form-group justify-content-center">
                    <button type="submit" class="rounded-pill p-2 btn btn-success mt-5 mb-3 col-md-10" name="formAjouter">
                        Ajouter
                    </button>
                </div>
        </fieldset>
    </form>
</div>

</body>

</html>