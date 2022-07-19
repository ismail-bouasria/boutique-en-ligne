<?php

session_start();
require '../classes/Bdd.php';
require '../classes/Souscategorie.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
$categorie = new Categorie('');
$sousCategorie = new SousCategorie('');



if (isset($_GET['modifier-categorie'])) {
    $_SESSION['get'] = intval($_GET['modifier-categorie']);

   
}elseif ($_GET['modifier-sous-categorie']) {
    $_SESSION['get'] = intval($_GET['modifier-categorie']);
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/boutique.css">
    <link rel="stylesheet" href="../assets/css/interface-produits.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/cssboot/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>

    <script src="https://kit.fontawesome.com/53bdaa6800.js" crossorigin="anonymous"></script>
    <title> Modification </title>
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

        <?php if (isset($_GET['modifier-categorie'])) { ?>
            <div class="contenairFormulair">

            <section>
                <h1>Modifier une catégorie</h1>
            </section>

            <form class="form1" action="../traitements/formulaire-categorie.php" method="post" enctype="multipart/form-data">

                <label>Nom</label>
                <input type="text" name="name">
                <label>Image </label>
                <input type="file" name="photo">
                <input id="bouton" type="submit" name="modcat" value='Modifier'>
            </form>

           
        </div>

       <?php }elseif (isset($_GET['modifier-sous-categorie'])) { ?>
     
            <div class="contenairFormulair">

            <section>
                <h1>modifier une sous categorie</h1>
            </section>

            <form class="form1" action="../traitements/formulaire-sous-categorie.php" method="post">

                <label>Choisir une catégorie:</label>
                <select name="category">
                    <option value="">catégories</option>
                    <?php $categorie->selectAllCategorie() ?>
                </select> 
                <label>Nom</label>
                <input type="text" name="name">

                <input id="bouton" type="submit" name="modsouscat" value='Modifier'>
            </form>

           
        </div>

       <?php }  ?>

    </main>

    <?php
    require '../require/footer.php';
    ?>
</body>

</html>