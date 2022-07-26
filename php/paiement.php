<?php
session_start();
require '../classes/Bdd.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
    <link rel="stylesheet" href="../assets/css/boutique.css">
    <link rel="stylesheet" href="../assets/css/interface-produits.css">
    <link rel="stylesheet" href="../assets/css/paiement.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/cssboot/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/53bdaa6800.js" crossorigin="anonymous"></script>
</head>

<body class="w-full h-full">
    <?php
    require '../require/header.php';
    ?>
    <main>
       <section class="contenairFormulair">
        <h1> Mode de paiement</h1>
      
        <form class="form1" action="../traitements/formulaire-paiement.php" method="post">
        <label for="">Numéro de la carte </label>
         <input type="number" name="numero">
         <label for="">Date d'expiration </label>
         <input type="date" name="date">
         <label for="">Code (CVC)</label>
         <div>
         <input   type="number" name="cvc">
         </div>
         <button  id="bouton" type="submit" name="payer">Valider le paiement</button>
        </form>
       </section>
    </main>
    <?php
    require '../require/footer.php';
    ?>
</body>

</html>