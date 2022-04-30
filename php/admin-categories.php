<?php

session_start();
require '../classes/Bdd.php';
require '../classes/Souscategorie.php';
require '../classes/Categorie.php';
$categorie = new Categorie('');
$sousCategorie = new SousCategorie('');

if (isset($_SESSION['droit']) == 'administrateur') {
} else {
    header('Location : accueil.php');
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
    <title>Administration Categories</title>

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
        <?php }elseif (isset($_GET['succed'])) { ?>
            <section id="messageSucces">
            <?php echo $_SESSION['reussi']; ?>
        </section>
       <?php } ?>
        <div class="contenairFormulair">

            <section>
                <h1>Ajouter une catégorie</h1>
            </section>

            <form action="../traitements/formulaire-categorie.php" method="post" enctype="multipart/form-data">


                <label>Nom</label>
                <input type="text" name="name">
                <label>Image </label>
                <input type="file" name="photo">
                <input id="bouton" type="submit" name="subcat" value='Ajouter la  catégorie'>
            </form>

            <section>
                <h1>Ajouter une sous categorie</h1>
            </section>

            <form action="../traitements/formulaire-sous-categorie.php" method="post"enctype="multipart/form-data">

                <label>Choisir une catégorie:</label>
                <select name="category">
                    <option value="">catégories</option>
                    <?php $categorie->selectAllCategorie() ?>
                </select>
                <label>Nom</label>
                <input type="text" name="name">

                <input id="bouton" type="submit" name="subsouscat" value='Ajouter la sous catégorie'>
            </form>


            <section>
                <h1>Liste des categories </h1>
            </section>
        </div>


    </main>

    <?php
    require '../require/footer.php';
    ?>
</body>

</html>