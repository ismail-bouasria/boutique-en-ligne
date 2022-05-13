<?php
session_start();
// <!-- =========================== TRAITEMENT INSCRIPTION ========================== -->

require "../classes/User.php";
// Requête d'inscription des utilisateurs dans la base de donnée.
if (isset($_POST['submit'])) {
  
  $login = htmlspecialchars($_POST['login']);
  $password = htmlspecialchars($_POST['password']);
  $confpass = htmlspecialchars($_POST['password2']);
  $email= htmlspecialchars($_POST['email']);
  $passhash = password_hash($password,PASSWORD_DEFAULT);
      
  $user = new User($login,$email,$passhash);
  
    
  // Requête pour ne pas inscrire plusieurs fois le même login/email. 
  if ($user->noSameLoginEmail($login,$email) == true) {

    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,}$/', $password)) {
      header('location:../php/inscription-connexion.php?mdp=incorrecte');
    }else {
      // Requête pour verifier le mot de passe et sa confirmation 
    if ($confpass == $password) {
      
     $user->register();
     header('location:../php/inscription-connexion.php?inscription=reussi');

    }else{
     header('location: ../php/inscription-connexion.php?err2=errorpassword');
      }
    }
    }else {
      header('location: ../php/inscription-connexion.php?err1=errorloginoremail');
    }
} 
    
?>