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
    <title>Accueil</title>
    <link rel="stylesheet" href="../assets/css/boutique.css">
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
       <section>
        <h1> Mode de paiement</h1>
       </section>

       <section>
        <form action="../traitements/formulaire-paiement.php"></form>
       </section>
    </main>
    <?php
    require '../require/footer.php';
    ?>
</body>

</html>