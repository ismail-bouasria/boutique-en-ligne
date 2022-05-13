<?php
session_start();
require '../classes/User.php';
require '../classes/Categorie.php';
require '../classes/Adresse.php';
require '../classes/Panier.php';
$adresse = new Adresse();
$user = new User('','','');


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
    <?php if (isset($_GET['err'])) { ?>
      <section id="messageErreur">
        <?php echo $_SESSION['erreur']; ?>
      </section>
    <?php } elseif (isset($_GET['succed'])) { ?>
      <section id="messageSucces">
        <?php echo $_SESSION['reussi']; ?>
      </section>
    <?php } ?>
    <section>
      <article id='edition'>
        <?php   $profil = $user->getInfosUserId($_SESSION['id'])?>
        <h2>Modifier vos <span>informations</span></h2>
        <form action="../traitements/formulaire-profil.php" method="post">
          <input type="text" name="login" value="<?php echo $profil['login']; ?>" >
          <input type="mail" name="email" value="<?php echo $profil['email']; ?>" >
          <input type="password" name="password" value="" placeholder="Entrer un nouveau mot de passe ou le même pour modifier le profil">
          <input type="password" name="password2" value="" placeholder="Confirmer un nouveau mot de passe ou le même pour modifier le profil">
          <a href="#"><button type="submit" name="modifierprofil">Modifier</button></a>
        </form>
      </article>
      <article id='adresse'>
        <?php
        $infos = $adresse->selectAdresseById(intval($_SESSION['id']));
        if (empty($infos)) { ?>

          <h2> Ajouter une <span> adresse ?</span></h2>
          <form action="../traitements/formulaire-adresse.php" method="post">
            <input type="text" name="nom" value="" placeholder="Nom">
            <input type="text" name="prenom" value="" placeholder="Prenom">
            <input type="text" name="adresse" value="" placeholder="Adresse">
            <input type="text" name="code" value="" placeholder="Code Postal">
            <input type="text" name="ville" value="" placeholder="Ville">
            <input type="text" name="telephone" value="" placeholder="Téléphone">
            <button type="submit" name="ajouter">Ajouter</button>
          </form>
         <?php } else { ?>
          <h2>Modifier votre <span> adresse ?</span></h2>
          <form action="../traitements/formulaire-adresse.php" method="post">
            <input type="text" name="nom" value="<?php echo $infos['nom']; ?>">
            <input type="text" name="prenom" value="<?php echo $infos['prenom']; ?>">
            <input type="text" name="adresse" value="<?php echo $infos['adresse']; ?>">
            <input type="text" name="code" value="<?php echo $infos['code_postal']; ?>">
            <input type="text" name="ville" value="<?php echo $infos['ville']; ?>">
            <input type="text" name="telephone" value="<?php echo $infos['telephone']; ?>">
             <button type="submit" name="modifier">Modifier</button>
            <?php  ?>
          <?php } ?>
      </article>
    </section>
  </main>
  <?php
  require '../require/footer.php';
  ?>
</body>

</html>