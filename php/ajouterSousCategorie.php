<?php
session_start();

require_once("../SousCategorie.php");
require_once("../Categorie.php");

$categorie = new Categorie();
$sousCategorie = new SousCategorie();

$lesCategories = $categorie->getLesCategories();

if (isset($_REQUEST["formAjouterSousCategorie"])) {
    $nom = $_REQUEST["nomSousCategorie"];
    var_dump($_REQUEST);
    $idCategorie = $_REQUEST["categorie"];
    $sousCategorie->ajouterSousCategorie($nom, $idCategorie);
    header("Location:listeSousCategorie.php");
}
include('../require/header.php');

?>

<form method="POST">
    <fieldset class="container mt-1 border border-5 p-2 rounded ">
        <legend class="float-none w-auto p-2">Ajouter catégorie</legend>
        <div class="row justify-content-center">
            <div class="form-group col-md-7 mt-2">
                <label for="nomSousCategorie">Nom</label>
                <input type="text" class="form-control" name="nomSousCategorie" placeholder="Entrez une catégorie" required>
            </div>
            <div class="form-group col-md-7 mt-2">
                <label for="categorie">Categorie</label>
                <select class="form-control" name="categorie">
                    <?php foreach ($lesCategories as $uneCategorie) : ?>
                        <option value="<?= $uneCategorie["id"] ?>">
                            <?= $uneCategorie["nom"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="text-center mt-3">
                <button type="submit" name="formAjouterSousCategorie" class="btn btn-primary">Ajouter</button>
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