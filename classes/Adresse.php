<?php

class Adresse extends Bdd

{
    private $id;
    public $nom;
    public $prenom;
    public $adresse;
    public $code;
    public $ville;
    public $telephone;
    public $id_utilisateur;

    public function __Construct()
    {
        parent::__construct();
       
    }



    public function addAdresse($nom, $prenom, $adresse, $code, $ville, $telephone, $id)
    {
        
        $sql = "INSERT INTO `adresses` (`nom`, `prenom`, `adresse`, `code_postal`, `ville`, `telephone`, `id_utilisateur`)
         VALUES (?,?,?,?,?,?,?)";
        $query = $this->bdd->prepare($sql);
        $query->execute([$nom,$prenom,$adresse,$telephone,$code,$ville,$id]);
    }


    public function updateAdresse($nom,$prenom,$adresse,$code,$ville,$telephone,$id){

        $sql= "UPDATE `adresses` 
        SET `nom`=?,`prenom`=?,`adresse`=?,`code_postal`=?,`ville`=?,`telephone`=?,`id_utilisateur`=? 
        WHERE 1";
        $query = $this->bdd->prepare($sql);
        $query->execute([$nom,$prenom,$adresse,$code,$ville,$telephone,$id]);
    }

    public function selectAdresseById($id){

        $sql= "SELECT * FROM `adresses` WHERE `id_utilisateur`=?";
        $query = $this->bdd->prepare($sql);
        $query->execute([$id]);
        $select = $query->fetchAll();
        return $select[0];
    }

    public function selectIdAdressByUser($id){

        $sql= "SELECT `id` FROM `adresses` WHERE `id_utilisateur`=?";
        $query = $this->bdd->prepare($sql);
        $query->execute([$id]);
        $select = $query->fetch();
        return $select[0];
    }
}
