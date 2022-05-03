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
    <script src="https://kit.fontawesome.com/53bdaa6800.js" crossorigin="anonymous"></script>
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

            <form action="../traitements/formulaire-sous-categorie.php" method="post" enctype="multipart/form-data">

                <label>Choisir une catégorie:</label>
                <select name="category">
                    <option value="">catégories</option>
                    <?php $categorie->selectAllCategorie() ?>
                </select>
                <label>Nom</label>
                <input type="text" name="name">

                <input id="bouton" type="submit" name="subsouscat" value='Ajouter la sous catégorie'>
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

                            <th> <h3>Nom</h3></th>
                            <th><h3>Action</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listeCategories as $uneCategorie) : ?>
                            <tr>

                                <td><?= $uneCategorie["nom"] ?></td>
                                <td>
                                    <div class="flex">
                                        <button id="edit"><a class="text-decoration-none" href="admin-categories?action=modifier&id=<?= $uneCategorie["id"] ?>">
                                            <i class="fas fa-user-edit text-primary edit"></i>
                                        </a></button>
                                    
                                    <button><a href="admin-categories.php?action=supprimer&id=<?= $uneCategorie["id"] ?>">
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
                                <i></i> Aucune catégorie pour l'instant. Veuillez en ajouter.
                            </li>
                        </ul>
                    </div>
                </div>
            <?php else : ?>
                <table>
                    <thead>
                        <tr>
                        <th> <h3>Categorie</h3></th>
                        <th> <h3>Nom</h3></th>
                        <th> <h3>Action</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listeSousCategories as $uneCategorie) : ?>
                            <tr>

                                <td><?= $uneCategorie["categoriesnom"] ?></td>
                                <td><?= $uneCategorie["sousnom"] ?></td>
                                <td>
                                    <div class="flex">
                                    <button> <a href="index.php?controleur=categorie&action=modifier&id=<?= $uneCategorie["souscatid"] ?>">
                                            <i class="fas fa-user-edit text-primary"></i>
                                        </a> </button>
                                   
                        <button> <a href="listeCategorie.php?action=supprimer&id=<?= $uneCategorie["souscatid"] ?>">
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