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
    <link rel="stylesheet" href="../assets/css/inscription-connexion.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
</head>
  <body>
  <?php
    require '../require/header.php';
    ?>
    <main>
      <section>
        <article id='inscription'>
          <h2>Modifier vos  <br><span>Information</span></h2>
            <form class="" action="index.html" method="post">
                <input type="mail" name="mail" value="" placeholder="Votre adresse email">
                <input type="password" name="password" value="" placeholder="Votre mot de passe">
                <input type="password" name="password2" value="" placeholder="Confirmez votre mot de passe">
                <input type="text" name="adress" value="" placeholder="Votre adresse">
                <a href="#"><button type="button" name="register">Inscription</button></a>
            </form>
        </article>
        <article id='connexion'>
          <h2> Ajouter une <br><span> Adresse ?</span></h2>
            <form class="" action="index.html" method="post">
                <input type="mail" name="mail" value="" placeholder="Votre adresse email">
                <input type="password" name="password" value="" placeholder="Votre mot de passe">
                <a href="#"><button type="button" name="login">Connexion</button></a>
                <small><a href="#">Mot de passe oublié ?</a></small>
            </form>
        </article>
      </section>
    </main>
    <?php
    require '../require/footer.php';
    ?>
  </body>
</html>
