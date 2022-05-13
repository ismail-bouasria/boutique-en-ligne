


<?php
session_start();
$_SESSION['erreur'] = '';
require '../classes/Bdd.php';
require '../classes/Adresse.php';
$addAdresse = new Adresse ();

// <!-- AJOUTER UNE ADRESSE -->

if (isset($_POST['ajouter'])){
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $code = intval($_POST['code']);
    $ville = htmlspecialchars($_POST['ville']);
    $tel = htmlspecialchars($_POST['telephone']);
    $id = intval($_SESSION['id']);
    
 
    if (!empty($nom) && !empty($prenom) && !empty($adresse) && !empty($code) && !empty($ville) && !empty($tel)) {
           
        $addAdresse->addAdresse($nom,$prenom,$adresse,$code,$ville,$tel,$id);

        header('location:../php/profil.php?succed=addadresse');
        $_SESSION['reussi'] = '<h1> Ajout de l\'adresse réussi !</h1> <p> Votre adresse a été correctement ajouté </p>';
        
    }else {
        header('Location: ../php/profil.php?err=noinfo');
        $_SESSION['erreur'] = '<h1> Ajout de l\'adresse Impossible !</h1> <p> Remplir tout les champs. </p>';
    }
}


// <!-- MODIFIER UNE ADRESSE -->
if (isset($_POST['modifier'])){
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $code = intval($_POST['code']);
    $ville = htmlspecialchars($_POST['ville']);
    $tel = htmlspecialchars($_POST['telephone']);
    $id = intval($_SESSION['id']);
     var_dump($id);
 
    if (!empty($nom) && !empty($prenom) && !empty($adresse) && !empty($code) && !empty($ville) && !empty($tel)) {
           
        $addAdresse->updateAdresse($nom,$prenom,$adresse,$code,$ville,$tel,$id);

        header('location:../php/profil.php?succed=updateadresse');
        $_SESSION['reussi'] = '<h1> Modification de l\'adresse réussi !</h1> <p> Votre adresse a été correctement modifiée </p>';
        
    }else {
        header('Location: ../php/profil.php?err=noinfo');
         $_SESSION['erreur'] = '<h1> Modification de l\'adresse Impossible !</h1> <p> Remplir tout les champs. </p>';
    }
}
?>