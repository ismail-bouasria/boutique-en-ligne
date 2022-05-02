<?php
session_start();

require("../Categorie.php");
$categorie = new Categorie();

if (isset($_REQUEST["formAjouterCategorie"])) {
    $nom = $_REQUEST["nomCategorie"];
    $categorie->ajouterCategorie($nom);
    header("Location:listeCategorie.php");
}
include('../require/header.php');

?>

<form method="POST">
    <fieldset class="container mt-1 border border-5 p-2 rounded ">
        <legend class="float-none w-auto p-2">Ajouter catégorie</legend>
        <div class="row justify-content-center">
            <div class="form-group col-md-7 mt-2">
                <label for="nomCategorie">Nom</label>
                <input type="text" class="form-control" name="nomCategorie" placeholder="Entrez une catégorie" required>
            </div>
            <div class="text-center mt-3">
                <button type="submit" name="formAjouterCategorie" class="btn btn-primary">Ajouter</button>
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