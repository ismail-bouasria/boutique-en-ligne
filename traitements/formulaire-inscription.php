<?php
// <!-- =========================== TRAITEMENT INSCRIPTION ========================== -->

require "../classes/User.php";
// Requête d'inscription des utilisateurs dans la base de donnée.
if (isset($_POST['submit'])) {
  
  $login = htmlspecialchars( $_POST['login']);
  $password = htmlspecialchars($_POST['password']);
  $confpass = htmlspecialchars($_POST['password2']);
  $email= htmlspecialchars($_POST['email']);


  $user = new User($login,$password,$email );
    
  // Requête pour ne pas inscrire plusieurs fois le même login/email. 
  if ($user->noSameLoginEmail($login,$email) == true) {
    // Requête pour verifier le mot de passe et sa confirmation 
    if ($confpass == $password) {
       $passhash = password_hash($password,PASSWORD_DEFAULT);
      $user->register($login,$passhash,$email);
      header('location:../php/connexion.php?inscription=reussi');

    }else{
      header('location: ../php/inscription.php?err2=errorpassword');
    }
    
  }else {
    header('location: ../php/inscription.php?err1=errorloginoremail');
  }
}
?>