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
    <title>Mode de Livraison</title>
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
            <section class="titre-livraison">
            <h1> MODE DE LIVRAISON</h1>
        </section>
        <div>
            <form class="contenair-livraison" action="" method="post">

                <button type="submit" name="click" class="livraison">
                    <img src="../assets/img/clickandcollect.png" alt="Clickandcollect">
                    <p class="click"> Click and collect</p>
                </button>

                <button type="submit" name="place" class="livraison">
                    <img src="../assets/img/surplace.png" alt="Manger sur place">
                    <p> Manger sur place</p>
                </button>

                <button type="submit" name="livraison" class="livraison">
                    <img src="../assets/img/livraison.png" alt="Livraison">
                    <p> Livraison </p>
                </button>
            </form>
        </div>
          <?php } ?>

    </main>
    <?php
    require '../require/footer.php';
    ?>
</body>

</html>