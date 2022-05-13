
<?php

require 'Bdd.php';

class User extends Bdd
{
    private $id;
    public $login;
    public $email;
    public $password;


    public function __Construct($login, $email, $password)
    {

        parent::__construct();
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
    }


    // Méthode pour inscrire l'user dans la bdd

    public function register()
    {
        $sql = "INSERT INTO `utilisateurs`(`login`, `email`,`password`) VALUES (?, ?, ?)";
        $register = $this->bdd->prepare($sql);
        $register->execute([$this->login, $this->email, $this->password]);
    }



    // Méthode ne pas enregister le meme login ou le même email dans la base de donnée. 
    public function noSameLoginEmail($login, $email)
    {
        $sql = "SELECT * FROM utilisateurs WHERE login = ? AND `email`=? ";
        $noSameLoginEmail =  $this->bdd->prepare($sql);
        $noSameLoginEmail->execute([$login, $email]);
        $loginEmail = $noSameLoginEmail->fetch();
        if (isset($loginEmail)) {
            if ($login != $loginEmail['login'] && $email != $loginEmail['email']) {
                return true;
            } else {
                return false;
            }
        }
    }


    // Méthode connect pour se connecter  au site via la base de donnée.
    public function connect($email, $password)
    {

        $sql = "SELECT * FROM utilisateurs WHERE email=?";
        $connect = $this->bdd->prepare($sql);
        $connect->execute([$email]);
        $connexion = $connect->fetch();


        if (!empty($email) && !empty($password)) {


            if ($email == $connexion['email'] && password_verify($password, $connexion['password'])) {

                $_SESSION['id'] = $connexion['id'];
                $_SESSION['username'] = $connexion['login'];

                if ($connexion['id_droit'] == 1) {
                    $_SESSION['droit'] = 'utilisateur';
                } elseif ($connexion['id_droit'] == 1337) {
                    $_SESSION['droit'] = 'administrateur';
                }
                header('location: ../php/accueil.php');
            } else {
                header('Location: ../php/inscription-connexion.php?err3=errormailpassword');
            }
        } else {
            header('Location: ../php/inscription-connexion.php?err3=errormailpassword');
        }
    }


    // Méthode pour selectionner tous les utilisateurs un utilisateur

public function selectAllInfosUser()
{
    $sql = "SELECT * FROM utilisateurs";
    $selectAllInfos = $this->bdd->prepare($sql);
    $selectAllInfos->execute();
    $selectAll = $selectAllInfos->fetchAll();

      return $selectAll;
}


    // Méthode pour supprimer un utilisateur
    public function deleteUser($id_utilisateur)
    {
        $sql = "DELETE FROM `utilisateurs` WHERE `id`=?";
        $deleteUser = $this->bdd->prepare($sql);
        $deleteUser->execute([$id_utilisateur]);
    }

   

    // Méthode pour récuperer le login et l'id des utilisateurs dans un select
    public function getAllLoginId()
    {
        $sql = "SELECT * FROM utilisateurs";
        $getAllLoginId = $this->bdd->prepare("SELECT * FROM utilisateurs");
        $getAllLoginId->execute();
        $getLoginId = $getAllLoginId->fetchAll();

        foreach ($getLoginId as $value) {

            echo '<option value="' . $value['id'] . '">' . $value['login'] . '</option>';
        }
    }

    // Méthode pour récuperer le login et l'id des utilisateurs dans un select
    public function getInfosUserId($id)
    {
        $sql = "SELECT * FROM utilisateurs WHERE id = ?";
        $getAllInfosId = $this->bdd->prepare($sql);
        $getAllInfosId->execute([$id]);
        $getAllInfos = $getAllInfosId->fetch();
        return $getAllInfos;

        
    }
    
    // methode pour afficher le login 
    public function getLogin($id)
    {
        $sql = "SELECT login FROM utilisateurs WHERE id=?";
        $getLogin = $this->bdd->prepare($sql);
        $getLogin->execute([$id]);
        $login = $getLogin->fetch();

        return $login['login'];
    }
    // methode pour afficher l'email
    public function getEmail($id)
    {
        $sql = "SELECT login FROM utilisateurs WHERE id=?";
        $getmail = $this->bdd->prepare($sql);
        $getmail->execute([$id]);
        $email = $getmail->fetch();

        return $email['email'];
    }

    // Méthode modifier les informations  du profilde la base de donnée.
    public function updateProfil($id)
    {
        $sql = "UPDATE `utilisateurs` SET `login`=?,`email`=?,`password`=?  WHERE `id`=?";
        $updateProfil = $this->bdd->prepare($sql);
        $updateProfil->execute([$this->login,$this->email,$this->password, $id]);
        $profil = $updateProfil->fetch();
        
            $_SESSION['username'] = $profil['login'];
            $_SESSION['email'] = $profil['email'];
            $_SESSION['password'] = $profil['password'];
        
    }


    // Méthode pour filtrer login et email pour l'update
    public function getfilterLoginEmail($login, $email)
    {
        $id = $_SESSION['id'];
        $getfilter = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE id != ?");
        $getfilter->execute([$id]);
        $filterLoginEmail = $getfilter->fetchAll();

        foreach ($filterLoginEmail as $getvalue) {
            // requête pour garder le même login et ne pas utiliser un login et email déjà existant.
            if ($getvalue['login'] != $login &&  $getvalue['email'] != $email) {

                return true;
            }
        }
    }

    //  Methode pour update les droits des utilisateurs 
    public function updateDroit($id_droits, $id)
    {

        $updateDroit = $this->bdd->prepare("UPDATE `utilisateurs`  SET `id_droits`=? WHERE `id` =?");
        $updateDroit->execute([$id_droits, $id]);
    }
}


//  $user = new User('','','');
//  $user->connect('a@gm.com','@Isma13700');


?>