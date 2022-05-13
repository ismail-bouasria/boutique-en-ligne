<?php
session_start();
require '../classes/Bdd.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription/Connexion</title>
    <link rel="stylesheet" href="../assets/css/boutique.css">
    <link rel="stylesheet" href="../assets/css/inscription-connexion.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    require '../require/header.php';
    ?>
    <main>
        <!-- Condition de messages d'inscription-connexion -->
        <?php
        if (isset($_GET['mdp'])) { ?>
            <section id="messageErreur">
                <h1>Inscription impossible !</h1>
                <p> Le mot de passe doit au moins contenir 8 charactères, un charactére spéciale,un chiffre et une majuscule. </p>
            </section>
        <?php } elseif (isset($_GET['err2'])) { ?>
            <section id="messageErreur">
                <h1>Inscription impossible !</h1> <br> La confirmation du mot de passe est incorrecte.
            </section>
        <?php } elseif (isset($_GET['err1'])) { ?>
            <section id="messageErreur">
                <h1>Inscription impossible !</h1>
                <p> Le login ou l'email est déjà utilisé.</p>
            </section>
        <?php } elseif (isset($_GET['err3'])) { ?>
            <section id="messageErreur">
                <h1>Connexion impossible !</h1>
                <p> votre email ou mot de passe est incorrecte.</p>
            </section>
        <?php } elseif (isset($_GET['inscription'])) { ?>
            <section id="messageSucces">
                <h1>Inscription Réussie !</h1>
                <p> Vous pouvez desormais vous connecter.</p>
            </section>
        <?php } elseif (isset($_GET['connexion'])) { ?>
            <section id="messageSucces">
                <h1>Connexion Réussie !</h1>
                <p> Vous pouvez desormais acceder au menu qui contient votre login.</p>
            </section>
        <?php } ?>

        <section id="formulaire">
            <article id='inscription'>
                <h2>Nouveaux chez nous ? <br><span>Inscrivez-vous</span></h2>
                <form action="../traitements/formulaire-inscription.php" method="post">
                    <input type="text" name="login" placeholder="Votre login">
                    <input type="mail" name="email" placeholder="Votre adresse email">
                    <p id="mdp">Le mot de passe doit au moins contenir 8 charactères, un charactére spéciale, un chiffre et une majuscule.</p>
                    <input type="password" name="password" placeholder="Votre mot de passe">
                    <input type="password" name="password2" placeholder="Confirmez votre mot de passe">
                    <a href="#"><button type="submit" name="submit">Inscription</button></a>
                </form>
            </article>
            <article id='connexion'>
                <h2>Déjà client ? <br><span>Connectez-vous !</span></h2>
                <form action="../traitements/formulaire-connexion.php" method="post">
                    <input type="mail" name="email" placeholder="Votre adresse email">
                    <input type="password" name="password" placeholder="Votre mot de passe">
                    <a href="#"><button type="submit" name="connexion">Connexion</button></a>
                    <small><a href="#">Mot de passe oublié ?</a></small>
                </form>
            </article>
        </section>

    </main>
    <?php
    require '../require/footer.php';
    ?>
</body>

</html>