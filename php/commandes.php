<?php

session_start();
require '../classes/User.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
require '../classes/Commandes.php';
$commandes = new Commandes();


if (!isset($_SESSION['id'])) {
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
    <link rel="stylesheet" href="../assets/cssboot/bootstrap.css">
    <script src="../js/search.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <title>Commandes</title>

</head>


<body>
    <?php
    require '../require/header.php';

    ?>
    <main>
        <div class="contenairCategorie">
            <section>
                <h1>Liste des commandes </h1>
            </section>

            <?php
            if ($_SESSION['droit'] == 'administrateur') {
                $listeCommandes = $commandes->selectAllCommandes();
                if (empty($listeCommandes)) : ?>
                    <div>
                        <div>
                            <ul>
                                <li>
                                    <i></i> Aucune commandes d'enregister
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php else : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <h3>Login</h3>
                                </th>
                                <th>
                                    <h3>Numero</h3>
                                </th>
                                <th>
                                    <h3>Panier</h3>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($listeCommandes as $commandes) : ?>
                                <tr>

                                    <td> <?= $commandes["login"] ?></td>
                                    <td><?= $commandes["numero"] ?></td>
                                    <td>
                                        <p> Nom : <?= $commandes["nom"] ?> </p> <p> Prix : <?= $commandes["prix"] ?></p> <p> Quantité : <?= $commandes["quantite"] ?> </p>
                                        <p> Total : <?php $total = [$commandes["prix"] * $commandes["quantite"]];
                                                    echo array_sum($total);  ?> €</p>
                                    </td>


                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
        </div> <?php
            } else {
                $listeCommandes = $commandes->selectAllCommandesByUser(intval($_SESSION['id']));
                if (empty($listeCommandes)) : ?>
            <div>
                <div>
                    <ul>
                        <li>
                            <i></i> Aucune commandes d'enregister
                        </li>
                    </ul>
                </div>
            </div>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>
                            <h3>Numero</h3>
                        </th>
                        <th>
                            <h3>Date</h3>
                        </th>
                        <th>
                            <h3>Panier</h3>
                        </th>


                    </tr>
                </thead>
                <tbody>

                    <?php

                    foreach ($listeCommandes as $commandes) : ?>
                        <tr>

                            <td> <?= $commandes["login"] ?></td>
                            <td><?= $commandes["numero"] ?></td>
                            <td>
                                        <p> Nom : <?= $commandes["nom"] ?> </p> <p> Prix : <?= $commandes["prix"] ?></p> <p> Quantité : <?= $commandes["quantite"] ?> </p>
                                        <p> Total : <?php $total = [$commandes["prix"] * $commandes["quantite"]];
                                                    echo array_sum($total);  ?> €</p>
                                    </td>


                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    <?php endif;
            } ?>
    </div>







    </main>

    <?php
    require '../require/footer.php';
    ?>
</body>

</html>