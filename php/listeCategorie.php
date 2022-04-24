<?php
session_start();
require_once("../Categorie.php");
$categorie = new Categorie();
$lesCategories = $categorie->getLesCategories();

if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "supprimer") {
    $id = $_REQUEST["id"];
    $categorie->supprimerCategorie($id);
    header("Location:listeCategorie.php");
}
include('../require/header.php');
?>
<h1 class="text-center mt-3">Les Catégories</h1>

<div class="text-center mt-3">
    <a href="ajouterCategorie.php">
        <button class="btn btn-primary">Ajouter</button>
    </a>
</div>
<?php if (empty($lesCategories)) : ?>
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
    <table class="table table-dark table-striped table-sm mt-3 container w-80 text-center">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Libelle</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lesCategories as $uneCategorie) : ?>
                <tr>
                    <td scope="row"><?= $uneCategorie["id"] ?></td>
                    <td><?= $uneCategorie["nom"] ?></td>
                    <td class="d-flex justify-content-center">
                        <div class="p-2">
                            <a class="text-decoration-none" href="index.php?controleur=categorie&action=modifier&id=<?= $uneCategorie["id"] ?>">
                                <i class="fas fa-user-edit text-primary"></i>
                            </a>
                        </div>
                        <div class="p-2">
                            <a href="listeCategorie.php?action=supprimer&id=<?= $uneCategorie["id"] ?>">
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