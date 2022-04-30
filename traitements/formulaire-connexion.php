<!-- =========================== TRAITEMENT CONNEXION ========================== -->   

<?php 
require "../classes/User.php";

//    Condition de connexion
if (isset($_POST['connexion'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $user = new User('','','');
    $user->connect($email,$password);
    
   
}
?>