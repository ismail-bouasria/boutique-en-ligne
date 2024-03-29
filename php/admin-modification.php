<?php

session_start();
require '../classes/Produit.php';
require '../classes/Souscategorie.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
$categorie = new Categorie('');
$sousCategorie = new SousCategorie('');
$produit = new Produit();



if (isset($_GET['modifier-'])) {
    $_SESSION['get'] = intval($_GET['modifier-categorie']);

   
}elseif (isset($_GET['modifier-sous-categorie'])&& $_GET['modifier-sous-categorie']) {
    $_SESSION['get'] = intval($_GET['modifier-sous-categorie']);
}elseif (isset($_GET['modifier-produit'])&& $_GET['modifier-produit']) {
    $_SESSION['get'] = intval($_GET['modifier-produit']);
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
    <script src="../js/search.js"></script>
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
                <?php 
                $getCategorie = $categorie->getCategorie($_SESSION['get']); ?>
                
                <label>Nom</label>
                <input type="text" name="name" value="<?php echo $getCategorie;?>">
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
                 <?php 
                 
                 $allSousCategories = $sousCategorie->getAllSousCategorieById($_SESSION['get']);

                 foreach ($allSousCategories as $value) { 
                   ?>
                   <label>Choisir une catégorie:</label>
                <select name="category">
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nom_cat'] ?></option>
                    <?php $categorie->selectAllCategorie() ?>
                </select> 
                <label>Nom</label>
                <input type="text" name="name" value="<?php echo $value['nom'] ?>">

                 <?php }?>

                <input id="bouton" type="submit" name="modsouscat" value='Modifier'>
            </form>

           
        </div>

       <?php }elseif (isset($_GET['modifier-produit'])) { ?>
         <div class="contenairFormulair">

         <section>
             <h1>Modifier un produit </h1>
         </section>

         <form class="form1" action="../traitements/formulaire-produit.php" method="post" enctype="multipart/form-data">
            <?php  
            $produitById = $produit->getAllProduitById($_SESSION['get']);

             foreach ($produitById as $value) { ?>
             
            <label>Choisir une sous-catégorie:</label>

            <select name="category">
                <option value="<?php echo $value['id_souscat'] ?>"><?php echo $value['nom_souscat'] ?></option>
                <?php $sousCategorie->selectAllSousCategorie() ?>
            </select>
            <label>Nom</label>
            <input type="text" name="name" value="<?php echo $value['nom'];?>">
            <label>Image </label>
            <input type="file" name="photo">
            <label>Description</label>
            <textarea name="description" cols="20" rows="5" contenteditable="true"><?php echo $value['description'];?></textarea>
            <label>Stock</label>
            <input type="number" name="stock" value="<?php echo $value['stock']; ?>">
            <label>Prix</label>
            <input type="text" name="price" value="<?php echo $value['prix'];?>">

            <input id="bouton" type="submit" name="modifprod" value='modifier'>
            
             <?php } ?>
             
         </form>
     </div>
      <?php } ?>

    </main>

    <?php
    require '../require/footer.php';
    ?>
</body>

</html>