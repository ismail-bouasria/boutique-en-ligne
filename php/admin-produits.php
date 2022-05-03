<?php

session_start();
require '../classes/Bdd.php';
require '../classes/Souscategorie.php';
require '../classes/Categorie.php';
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
    <script src="https://kit.fontawesome.com/53bdaa6800.js" crossorigin="anonymous"></script>
    <title>Administration Produits</title>

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
                <h1>Ajouter un produit </h1>
            </section>

            <form action="../traitements/formulaire-produit.php" method="post" enctype="multipart/form-data">

                <label>Choisir une sous-catégorie:</label>

                <select name="category">
                    <option value="">catégories</option>
                    <?php $sousCategorie->selectAllSousCategorie() ?>
                </select>
                <label>Nom</label>
                <input type="text" name="name">
                <label>Image </label>
                <input type="file" name="photo">
                <label>Description</label>
                <textarea name="description" cols="20" rows="5"></textarea>
                <label>Stock</label>
                <input type="number" name="stock">
                <label>Prix</label>
                <input type="text" name="price">

                <input id="bouton" type="submit" name="submit" value='Ajouter le produit'>
            </form>
        </div>

        <div class="contenairCategorie">
            <section>
                <h1>Liste des produits categories </h1>
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
                            <th>
                                <h3>Sous Categorie</h3>
                            </th>
                            <th>
                                <h3>Image</h3>
                            </th>
                            <th>
                                <h3>Nom</h3>
                            </th>
                            <th>
                                <h3>Descritpiton</h3>
                            </th>
                            <th>
                                <h3>Prix</h3>
                            </th>
                            <th>
                                <h3>stock</h3>
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
                                <td><?= $uneCategorie["categoriesnom"] ?></td>
                                <td><?= $uneCategorie["sousnom"] ?></td>
                                <td><?= $uneCategorie["categoriesnom"] ?></td>
                                <td><?= $uneCategorie["sousnom"] ?></td>

                                <td>
                                    <div class="flex">
                                        <button id="size"> <a href="index.php?controleur=categorie&action=modifier&id=<?= $uneCategorie["souscatid"] ?>">
                                                <i class="fas fa-user-edit text-primary"></i>
                                            </a> </button>

                                        <button  id="size"> <a href="listeCategorie.php?action=supprimer&id=<?= $uneCategorie["souscatid"] ?>">
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