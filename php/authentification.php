<?php
session_start();
require("../User.php");
$user = new User();

if (isset($_REQUEST["formInscription"])) {
    $login = htmlspecialchars($_REQUEST["identifiant"]);
    $password = htmlspecialchars($_REQUEST["motDePasse"]);
    $email = htmlspecialchars($_REQUEST["email"]);

    $user->Register($login, $password, $email);
}

if (isset($_REQUEST["formConnexion"])) {
    $login = $_REQUEST["identifiant"];
    $password = ($_REQUEST["motDePasse"]);

    $user->Connect($login, $password);
}

if (isset($_REQUEST["formModifier"])) {
    header("Location:modiff utilisateur.php");
}

include("../require/header.php"); ?>
<?php if (!isset($_SESSION["connected"]) || !$_SESSION["connected"]) : ?>
    <div class="container row justify-content-center mx-auto">
        <form class="col-md-6 " method="post" action="">
            <fieldset class="container mt-1 border border-dark border-2 p-1 rounded">
                <h3 class="no">Nouveau chez nous ?</h2>
                    <h4 class="in">Inscrivez-vous</h4>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="login">Identifiant *</label>
                        <input type="text" class="form-control" name="identifiant" placeholder="Entrez un identifiant">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="email">Email *</label>
                        <input type="email" class="form-control" name="email" placeholder="Entrez votre email">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="motDePasse">Mot de passe *</label>
                        <input type="password" class="form-control" name="motDePasse" placeholder="Entrez un mot de passe">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="confirmerMotDePasse">Confirmer votre mot de passe *</label>
                        <input type="password" class="form-control" name="confirmerMotDePasse" placeholder="Confirmer le Mot de passe">
                    </div>
                    <div class="btn-group-md text-center mt-2">
                        <button type="submit" class="rounded-pill p-2 btn btn-success mt-5 mb-3 col-md-10" name="formInscription">
                            Inscription
                        </button>
                    </div>
            </fieldset>

        </form>
        <form class="col-md-6 " method="post" action="">
            <fieldset class="container mt-1 border border-dark border-2 p-2 rounded">
                <h3 class="no">Déja client ?</h2>
                    <h4 class="co">Connecter-vous</h4>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="login">Identifiant *</label>
                        <input type="text" class="form-control" name="identifiant" placeholder="Entrez un identifiant">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="motDePasse">Mot de passe *</label>
                        <input type="password" class="form-control" name="motDePasse" placeholder="Entrez un mot de passe">
                    </div>
                    <div class="container">
                        <spa class="psw"><a href="forgot_password.php">Mot de passe oublié ?</a></span>
                    </div>
                    <div class="btn-group-md text-center mt-5">
                        <button type="submit" class="rounded-pill p-2 btn btn-success mt-4 mb-3 col-md-10" name="formConnexion">
                            Connexion
                        </button>
                    </div>
            </fieldset>
        </form>
    </div>

<?php else : ?>
    <?php header("Location: accueil.php"); ?>
<?php endif; ?>
</body>

</html>