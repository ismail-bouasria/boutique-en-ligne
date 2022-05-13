<!----------------------------------------------------FORMULAIRE PROFIL---------------------------------------->
<?php
session_start();
require '../classes/User.php';
// CONDITION DE L'EDITE
if (isset($_POST['modifierprofil'])) {

    $login = htmlspecialchars($_POST['login']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['password']);
    $pass2 = htmlspecialchars($_POST['password2']);
    $passhash = password_hash($pass,PASSWORD_DEFAULT);
   
    $id = intval($_SESSION['id']);


    if (!empty($login) && !empty($email) && !empty($pass) && !empty($pass2)) {
        $user = new User($login,$email,$passhash);
        if ($user->getfilterLoginEmail($login, $email) == true) {
            if ($pass2 == $pass) {
                $user->updateProfil($id);
                 $_SESSION['username'] = $login;
                header('location:../php/profil.php?succed=updateprofil');
                $_SESSION['reussi'] = '<h1> Modification du profil réussi !</h1> <p> Votre profil a été correctement modifié </p>';
            } else {
                header('Location: ../php/profil.php?err=password');
                $_SESSION['erreur'] = '<h1> Modification du profil Impossible !</h1> <p> Confirmation du mot de passe incorrecte. </p>';
            }
        } else {
            header('Location: ../php/profil.php?err=same');
            $_SESSION['erreur'] = '<h1> Modification du profil Impossible !</h1> <p> Login ou Email déjà existant. </p>';
        }
    } else {
        header('Location: ../php/profil.php?err=noinfo');
        $_SESSION['erreur'] = '<h1> Modification du profil Impossible !</h1> <p> Remplir tout les champs. </p>';
    }
} ?>