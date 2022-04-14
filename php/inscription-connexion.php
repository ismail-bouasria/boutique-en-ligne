<?php
session_start();
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
        <?php
        if (isset($_GET['inscription'])) {
            
        }
        ?>
    <section>
            <article id='inscription'>
                <h2>Nouveaux chez nous ? <br><span>Inscrivez-vous</span></h2>
                <form action="../traitements/formulaire-inscription.php" method="post">
                    <input type="text" name="login" placeholder="Votre login">
                    <input type="mail" name="email" placeholder="Votre adresse email">
                    <input type="password" name="password" placeholder="Votre mot de passe">
                    <input type="password" name="password2" placeholder="Confirmez votre mot de passe">
                    <a href="#"><button type="submit" name="submit">Inscription</button></a>
                </form>
            </article>
            <article id='connexion'>
                <h2>Déjà client ? <br><span>Connectez-vous !</span></h2>
                <form class="" action="index.html" method="post">
                    <input type="mail" name="mail" value="" placeholder="Votre adresse email">
                    <input type="password" name="password" value="" placeholder="Votre mot de passe">
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