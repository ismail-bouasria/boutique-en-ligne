<?php
session_start();
include('../require/header.php');
?>
<div class="container mt-2">
    <div class="col d-flex justify-content-around">
        <div>
            <div class="text-center"> <img src="../assets/img/profil.png" width="100" class="rounded-circle"> </div>
            <h5 class="mt-2 text-center">
                <?= $_SESSION["utilisateur"]["login"]   ?>
            </h5>
            <div class="text-center mb-2">
                <span class="bg-secondary p-1 px-4 rounded text-white"><?= $_SESSION["utilisateur"]["droit"] ?></span>
            </div>
        </div>
        <div>
            <ul class="list-group list-group-flush text-center d-flex">
                <li class="list-group-item">
                    <span class="fw-bold">Prenom/Nom</span>
                    <?= (empty($_SESSION["utilisateur"]["prenom"]) || empty($_SESSION["utilisateur"]["nom"])) ?
                        "Non renseigné" :
                        " (" . $_SESSION["utilisateur"]["prenom"] . " " . $_SESSION["utilisateur"]["nom"] . ")" ?>
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Telephone</span>
                    <?= (empty($_SESSION["utilisateur"]["telephone"])) ? "Non renseigné" : $_SESSION["utilisateur"]["telephone"] ?>
                </li>
                <li class="list-group-item">
                    <span class="fw-bold">Email</span>
                    <?= $_SESSION["utilisateur"]["email"] ?>
                </li>

                <li class="list-group-item">
                    <span class="fw-bold">Adresse</span>
                    <?= (empty($_SESSION["utilisateur"]["adresse"])) ? "Non renseigné" : $_SESSION["utilisateur"]["adresse"] ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="col d-flex justify-content-around">
        <div>
            <a href="modifierProfil.php" class="btn btn-outline-primary px-4 mt-3">
                Modifier
            </a>
        </div>

        <div>
            <a href="deconnexion.php" class="btn btn-outline-danger px-4 mt-3">
                Deconnexion
            </a>
        </div>
    </div>

</div>
<?php
include('../require/footer.php');
?>
</body>

</html>