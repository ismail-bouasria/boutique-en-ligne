<?php
session_start();
require '../classes/Bdd.php';
require '../classes/Souscategorie.php';
$_SESSION['erreur'] = '';

if (isset($_POST['subsouscat'])) {
    $nom = htmlspecialchars($_POST['name']);
    $id = $_POST['category'];

    if (!empty($nom)) {

        // Vérifie si le fichier a été uploadé sans erreur.

        $sousCategorie = new Souscategorie('');
        if (empty($sousCategorie->getNameSousCategorie($nom))) {

            $sousCategorie->addSousCategorie($nom, $id, $path);

            header('location:../php/admin-categories.php?succed=addcategory');
            $_SESSION['reussi'] = '<h1> Ajout de sous-catégorie réussi !</h1> <p> Nouvelle catégorie a été ajoutée. </p>';
        } else {
            header('Location: ../php/admin-categories.php?err=samecategory');
            $_SESSION['erreur'] = '<h1> Ajout de sous-catégorie Impossible !</h1> <p> La catégorie existe déjà. </p>';
        }
    } else {
        header('Location: ../php/admin-categories.php?err=noinfos');
        $_SESSION['erreur'] = '<h1> Ajout de sous-catégorie Impossible !</h1> <p> Remplir les champs. </p>';
    }
    
} 


if (isset($_POST['modsouscat'])) {
    $nom = htmlspecialchars($_POST['name']);
    $id = $_POST['category'];
    $idSousCategorie = $_SESSION['get'];

    if (!empty($nom)) {

        $sousCategorie = new Souscategorie('');
        $nomSousCategorie= $sousCategorie->getNameSousCategorie($nom);
        if (empty($nomSousCategorie) || $nom == $nomSousCategorie) {

            $sousCategorie->UpdateSousCategorie($nom,$id);

            header('location:../php/admin-modification.php?modifier-sous-categorie='.$idSousCategorie.'&succed=addcategory');
            $_SESSION['reussi'] = '<h1> Modification de la sous-catégorie réussi !</h1> <p> Nouvelle catégorie a été ajoutée. </p>';
        } else {
            header('Location: ../php/admin-modification.php?modifier-sous-categorie='.$idSousCategorie.'&err=samecategory');
            $_SESSION['erreur'] = '<h1> Modification de la sous-catégorie Impossible !</h1> <p> La catégorie existe déjà. </p>';
        }
    } else {
        header('Location: ../php/admin-modification.php?modifier-sous-categorie='.$idSousCategorie.'&err=noinfos');
        $_SESSION['erreur'] = '<h1> Modification de la sous-catégorie Impossible !</h1> <p> Remplir les champs. </p>';
    }
}

?>