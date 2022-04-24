<?php
session_start();
require("../Produit.php");
$produit = new Produit();
$lesProduits = $produit->getLesProduits();

if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "supprimer") {
    $id = $_REQUEST["id"];
    $produit->supprimerProduit($id);
    header("Location:listeProduit.php");
}

include('../require/header.php');
?>
<h1 class="text-center mt-3">Les Produits</h1>
<div class="text-center mt-3">
    <a href="ajouterProduit.php">
        <button class="btn btn-primary">Ajouter</button>
    </a>
</div>
<?php if (empty($lesProduits)) : ?>
    <div class="container rounded mt-2 text-center fw-bold">
        <div class="row">
            <ul class="list-group col-md-8 col-12 mx-auto">
                <li class="list-group-item list-group-item-danger">
                    <i class="fas fa-exclamation-circle text-danger"></i> Aucun article pour l'instant. Veuillez en ajouter.
                </li>
            </ul>
        </div>
    </div>
<?php else : ?>
    <table class="table table-dark table-striped table-sm mt-3 container">
        <thead>
            <tr>
                <th scope="col">nom</th>
                <th scope="col">description</th>
                <th scope="col">prix</th>
                <th scope="col">stock</th>
                <th scope="col">Categorie</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lesProduits as $unProduit) : ?>
                <tr>
                    <td scope="row"><?= $unProduit["nom"] ?></td>
                    <td><?= $unProduit["description"] ?></td>
                    <td><?= $unProduit["prix"] ?>€</td>
                    <td><?= $unProduit["stock"] ?></td>
                    <td><?= $unProduit["categorie"] ?></td>
                    <td class="d-flex justify-content-start">
                        <div class="p-2">
                            <a class="text-decoration-none" href="index.php?controleur=article&action=modifier&id=<?= $unProduit["id"] ?>">
                                <i class="fas fa-user-edit text-primary"></i>
                            </a>
                        </div>
                        <div class="p-2">
                            <a href="listeProduit.php?action=supprimer&id=<?= $unProduit["id"] ?>">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<?php
include('../require/footer.php');
?>
</body>

</html>