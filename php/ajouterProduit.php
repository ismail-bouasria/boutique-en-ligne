<?php
session_start();

require("../Produit.php");
$produit = new Produit();
require_once("../SousCategorie.php");
$sousCategorie = new SousCategorie();
$lesSousCategories = $sousCategorie->getLesSousCategories();


if (isset($_REQUEST["formAjouterProduit"])) {
    $nom = $_REQUEST["nom"];
    $description = $_REQUEST["description"];
    $prix = $_REQUEST["prix"];
    $stock = $_REQUEST["stock"];
    $cat = $_REQUEST["categorie"];
    $produit->ajouterProduit($nom, $description, $prix, $stock, $cat);
    header("Location:listeProduit.php");
}

include('../require/header.php');
?>

<form method="POST">
    <fieldset class="container mt-1 border border-5 p-2 rounded">
        <legend class="float-none w-auto p-2">Ajouter Produit</legend>
        <div class="row justify-content-center">
            <div class="form-group col-md-7 mt-2">
                <label for="nom">nom</label>
                <input type="text" class="form-control" name="nom" placeholder="Entrez un nom" required>
            </div>
            <div class="form-group col-md-7 mt-2">
                <label for="description">description</label>
                <textarea class="form-control" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group col-md-7 mt-2">
                <label for="prix">prix</label>
                <input step=".01" type="number" class="form-control" name="prix" required>
            </div>
            <div class="form-group col-md-7 mt-2">
                <label for="stock">stock</label>
                <input type="number" class="form-control" name="stock" required>
            </div>
            <div class="form-group col-md-7 mt-2">
                <label for="categorie">Sous Categorie</label>
                <select class="form-control" name="categorie">
                    <?php foreach ($lesSousCategories as $uneCategorie) : ?>
                        <option value="<?= $uneCategorie["id"] ?>">
                            <?= $uneCategorie["nom"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary" name="formAjouterProduit">Ajouter</button>
            </div>
        </div>
        </div>
    </fieldset>
</form>

<?php
include('../require/footer.php');
?>
</body>

</html>