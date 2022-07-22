<?php


class Commandes extends Bdd

{
    private $id;


    public function __Construct()
    {

        parent::__construct();
    }



    //  Methode pour enregister la commande : 
    public function createCommande($numero, $idUser)
    {
        
        $sql = "INSERT INTO `commandes`( `numero`, `id_utilisateur`) VALUES (?,?)";
        $addCommande = $this->bdd->prepare($sql);
        $addCommande->execute([$numero, $idUser]);
    }


//  Methode pour selectionner le numero de commande si la commande existe déjà et en cours (ON) : 
public function getNumero($idUser)
{
    $sql = "SELECT `numero` FROM `commandes` WHERE `id_utilisateur`= ?  AND `etat`='on'";
    $getNumero = $this->bdd->prepare($sql);
    $getNumero->execute([$idUser]);
    $numero=$getNumero->fetch();

    return $numero[0];
    
}
  
public function UpdateAdressCommande($idAdress,$idUser)
{
    $sql = "UPDATE `commandes` SET `id_adresse`= ? WHERE `id_utilisateur`= ? ";
    $getAdress = $this->bdd->prepare($sql);
    $getAdress->execute([$idAdress,$idUser]);

   
    
}
}
