<?php

session_start();
require '../classes/Bdd.php';
require '../classes/Souscategorie.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
$categorie = new Categorie('');
$sousCategorie = new SousCategorie('');


    if (isset($_GET['supprimer'])) {
        $id =  intval($_GET['supprimer']);
     $categorie->deleteCategorie($id);
     $_SESSION['reussi'] = '<h1> Suppression catégorie réussi !</h1>';
     }elseif (isset($_GET['supprSCat'])) {
         $id =  intval($_GET['supprSCat']);
         $sousCategorie->deleteSousCategorie($id);
         $_SESSION['reussi'] = '<h1> Suppression sous-catégorie réussi !</h1>';
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
        <?php } elseif (isset($_GET['succed'])) { ?>
            <section id="messageSucces">
                <?php echo $_SESSION['reussi']; ?>
            </section>
        <?php } ?>
        <div class="contenairFormulair">

            <section>
                <h1>Ajouter une catégorie</h1>
            </section>

            <form class="form1" action="../traitements/formulaire-categorie.php" method="post" enctype="multipart/form-data">


                <label>Nom</label>
                <input type="text" name="name">
                <label>Image </label>
                <input type="file" name="photo">
                <input id="bouton" type="submit" name="subcat" value='Ajouter'>
            </form>

            <section>
                <h1>Ajouter une sous categorie</h1>
            </section>

            <form class="form1" action="../traitements/formulaire-sous-categorie.php" method="post">

                <label>Choisir une catégorie:</label>
                <select name="category">
                    <option value="">catégories</option>
                    <?php $categorie->selectAllCategorie() ?>
                </select> 
                <label>Nom</label>
                <input type="text" name="name">

                <input id="bouton" type="submit" name="subsouscat" value='Modifier'>
            </form>


        </div>

        <div class="contenairCategorie">

            <section>
                <h1>Liste des categories </h1>
            </section>

            <?php
            $listeCategories = $categorie->getAllCategorie();
            if (empty($listeCategories)) : ?>
                <div class="container rounded mt-2 text-center fw-bold">
                    <div class="row">
                        <ul class="list-group col-md-8 col-12 mx-auto">
                            <li class="list-group-item list-group-item-danger">
                                <i class="fas fa-exclamation-circle text-danger"></i> Aucune catégorie pour l'instant. Veuillez en ajouter.
                            </li>
                        </ul>
                    </div>
                </div>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>

                            <th>
                                <h3>Nom</h3>
                            </th>
                            <th>
                                <h3>Action</h3>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listeCategories as $uneCategorie) : ?>
                            <tr>

                                <td><?= $uneCategorie["nom"] ?></td>
                                <td>
                                    <div class="flex">
                                        <button class="responsbutton" id="edit"><a href="admin-modification.php?modifier-categorie=<?= $uneCategorie["id"] ?>">
                                                <i class="fas fa-user-edit text-primary edit"></i>
                                            </a></button>

                                        <button class="responsbutton"><a href="admin-categories.php?supprimer=<?= $uneCategorie["id"] ?>">
                                        
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </a></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div class="contenairCategorie">
            <section>
                <h1>Liste des sous categories </h1>
            </section>

            <?php
            $listeSousCategories = $sousCategorie->getAllSousCategorie2();
            if (empty($listeSousCategories)) : ?>
                <div>
                    <div>
                        <ul>
                            <li>
                                <i></i> Aucune sous-catégorie pour l'instant. Veuillez en ajouter.
                            </li>
                        </ul>
                    </div>
                </div>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                            <th>
                                <h3>Categorie</h3>
                            </th>
                            <th>
                                <h3>Nom</h3>
                            </th>
                            <th>
                                <h3>Action</h3>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listeSousCategories as $uneCategorie) : ?>
                            <tr>

                                <td><?= $uneCategorie["categoriesnom"] ?></td>
                                <td><?= $uneCategorie["sousnom"] ?></td>
                                <td>
                                    <div class="flex">
                                        <button class="responsbutton"> <a href="admin-modification.php?modifier-sous-categorie=<?= $uneCategorie["souscatid"] ?>">
                                                <i class="fas fa-user-edit text-primary"></i>
                                                
                                            </a> </button>

                                        <button class="responsbutton"> <a href="admin-categories.php?supprSCat=<?=$uneCategorie["souscatid"];?>">
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </a> </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>


    </main>

    <?php
    require '../require/footer.php';
    ?>
</body>

</html>