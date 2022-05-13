<?php

session_start();
require '../classes/User.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';

$user = new User('','','');


if (isset($_SESSION['droit']) == 'administrateur') {
} else {
    header('Location : accueil.php');
}

if (isset($_GET['supprimer'])) {
    $id =  intval($_GET['supprimer']);
 $user->deleteUser($id);
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
    <title>Utilisateurs</title>

</head>


<body>
    <?php
    require '../require/header.php';

    ?>
    <main>
        <div class="contenairCategorie">
            <section>
                <h1>Liste des utilisateurs </h1>
            </section>

            <?php
            $listeUser = $user->selectAllinfosUser();
            if (empty($listeUser)) : ?>
                <div>
                    <div>
                        <ul>
                            <li>
                                <i></i> Aucun utilisateur d'enregister
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
                                <h3>Email</h3>
                            </th>
                         
                            <th>
                                <h3>Action</h3>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                     
                        foreach ($listeUser as $user) : ?>
                            <tr>

                                <td> <?= $user["login"]?></td>
                                <td><?= $user["email"]?></td>
                                
                            </td>
                                <td>
                                    <div class="flex">
                                            
                                        <button id="size"> <a href="utilisateurs.php?supprimer=<?= $user['id'] ?>">
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </a> </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        
    </main>

    <?php
    require '../require/footer.php';
    ?>
</body>

</html>