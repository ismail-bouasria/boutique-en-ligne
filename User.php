<?php
class User
{
    //Attributs
    private $bdd;
    private $id;
    private $login;
    private $password;
    private $email;



    //Méthodes
    public function __construct()
    {
        $this->bdd = new PDO('mysql:host=localhost; dbname=boutique-en-ligne', 'root', ''); //Connexion à la bdd
        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function Register($login, $password, $email)
    {
        if (empty($this->getUnUtilisateurParLogin($login))) {
            $ruser = "INSERT INTO utilisateurs(login,password,email) 
                      VALUES(:login, :password, :email)";
            $req = $this->bdd->prepare($ruser);
            $req->execute([
                ':login' => $login,
                ':password' => $password,
                ':email' => $email,
            ]);
            echo "L'utilisateur " . $login . " a été créé avec succès.";

            $user = $this->getUnUtilisateurParLogin($login);

            $this->id           = $user['id'];
            $this->login        = $user['login'];
            $this->email        = $user['email'];
            $this->password     = $user['password'];
            return $user;
        } else {
            echo "L'utilisateur " . $login . " existe déjà.";
        }
    }

    public function getUnUtilisateurParLogin($login) //Select
    {
        $req = "SELECT  * 
                FROM    utilisateurs 
                WHERE   login = :login";
        $query = $this->bdd->prepare($req);
        $query->execute([':login' => $login]);
        return $query->fetch();
    }

    public function Connect($login, $password)
    {

        $req = "SELECT      utilisateurs.id,
                            utilisateurs.nom,
                            prenom,
                            adresse,
                            telephone,
                            droits.nom AS droit,
                            email,
                            login
                FROM        utilisateurs
                INNER JOIN droits
                ON          utilisateurs.id_droit = droits.id
                WHERE       login       = :login && 
                            password    = :password";
        $query = $this->bdd->prepare($req);
        $query->execute([':login' => $login, ':password' => $password]);
        $result = $query->fetch();

        if (empty($result)) {
            echo "Le login et/ou le mot de passe est incorrect.";
        } else {

            $_SESSION["utilisateur"] = $result;
            echo "Bonjour " . $login . ", Vous êtes maintenant connecté !";
            $_SESSION["connected"] = true;
        }
    }

    public function Update($login, $password, $email)
    {
        $id = $_SESSION["utilisateur"]["id"];
        $req = "UPDATE  utilisateurs 
                SET     login           = :login, 
                        password        = :password, 
                        email        = :email
                WHERE   id              = :id";
        $query = $this->bdd->prepare($req);

        $query->execute([':login' =>  $login, ':email' => $email, ':password' => $password, ':id' => $id]);
        echo 'update ok';
    }

    public function ajouterAdresse($nom, $prenom, $adresse, $telephone)
    {
        $id = $_SESSION["utilisateur"]["id"];
        $req = "UPDATE  utilisateurs 
                SET     nom = :nom,
                        prenom = :prenom,
                        adresse = :adresse,
                        telephone = :telephone
                WHERE   id = :id";
        $query = $this->bdd->prepare($req);
        $query->execute([':nom' =>  $nom, ':prenom' => $prenom, ':adresse' => $adresse, 'telephone' => $telephone, ':id' => $id]);
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
}
