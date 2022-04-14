<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="../assets/css/boutique.css">
    <link rel="stylesheet" href="../assets/css/profil.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
</head>
  <body>
  <?php
    require '../require/header.php';
    ?>
    <main>
      <section>
        <article id='edition'>
          <h2>Modifier vos <span>informations</span></h2>
            <form class="" action="index.html" method="post">
                <input type="text" name="login" value="" placeholder="Votre login">
                <input type="mail" name="mail" value="" placeholder="Votre adresse email">
                <input type="password" name="password" value="" placeholder="Votre mot de passe">
                <input type="password" name="password2" value="" placeholder="Confirmez votre mot de passe">
                <a href="#"><button type="button" name="register">Modifier</button></a>
            </form>
        </article>
        <article id='adresse'>
          <h2> Ajouter une <span> adresse ?</span></h2>
            <form class="" action="index.html" method="post">
                <input type="text" name="nom" value="" placeholder="Nom">
                <input type="text" name="prenom" value="" placeholder="Prenom">
                <input type="text" name="numeroRue" value="" placeholder="Numero de rue">
                <input type="text" name="nomRue" value="" placeholder="Nom de rue">
                <input type="text" name="codePostal" value="" placeholder="Code Postal">
                <input type="text" name="ville" value="" placeholder="Ville">
                <input type="text" name="telephone" value="" placeholder="Téléphone">
                <a href="#"><button type="button" name="login">Ajouter</button></a>
            </form>
        </article>
      </section>
    </main>
    <?php
    require '../require/footer.php';
    ?>
  </body>
</html>
