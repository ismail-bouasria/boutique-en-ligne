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
    public function getNumeroCommande($idUser)
    {
        $sql = "SELECT `numero` FROM `commandes` WHERE `id_utilisateur`= ?  AND `etat`='off'";
        $getNumero = $this->bdd->prepare($sql);
        $getNumero->execute([$idUser]);
        $numero = $getNumero->fetch();

        return $numero[0];
    }

    //  Methode pour selectionner le numero de commande si la commande existe déjà et en cours (ON) : 
    public function getNumero($idUser)
    {
        $sql = "SELECT `id` FROM `commandes` WHERE `id_utilisateur`= ?  AND `etat`='on'";
        $getNumero = $this->bdd->prepare($sql);
        $getNumero->execute([$idUser]);
        $numero = $getNumero->fetch();

        return $numero[0];
    }

    // Methode pour changer l'adresse de la commande

    public function UpdateAdressCommande($idAdress, $idUser)
    {
        $sql = "UPDATE `commandes` SET `id_adresse`= ? WHERE `id_utilisateur`= ? ";
        $getAdress = $this->bdd->prepare($sql);
        $getAdress->execute([$idAdress, $idUser]);
    }



    // Methode pour changer la date et l'état de la commande 
    public function finishCommande($idUser)
    {
        $sql = "UPDATE `commandes` SET `date`= Now(),`etat`='off' WHERE `id_utilisateur`= ? ";
        $getAdress = $this->bdd->prepare($sql);
        $getAdress->execute([$idUser]);
    }



    public function getCommande($idUser,$idCommande)
    {
        $sql = "SELECT commandes.numero,commandes.date, commandes.id_adresse,produits.nom, produits.prix, historiques_panier.quantite 
        FROM `commandes` 
        JOIN historiques_panier ON historiques_panier.id_commande = commandes.id 
        JOIN produits ON produits.id = historiques_panier.id_produit 
        WHERE commandes.id_utilisateur= ? AND historiques_panier.id_commande= ? ";
        $getCommande = $this->bdd->prepare($sql);
        $getCommande->execute([$idUser,$idCommande]);
        $commande = $getCommande->fetchAll();

        return $commande;
    }
   
    //Methode pour selectionner toute les commandes 

    public function SelectAllCommandes()
    {
        $sql = "SELECT  utilisateurs.login,commandes.id,commandes.numero,commandes.id_adresse,commandes.date, historiques_panier.quantite,produits.nom,produits.prix 
        FROM commandes 
        JOIN historiques_panier ON commandes.id = historiques_panier.id_commande 
        JOIN produits ON produits.id = historiques_panier.id_produit 
        JOIN utilisateurs ON utilisateurs.id = commandes.id_utilisateur";
        $getAllCommande = $this->bdd->prepare($sql);
        $getAllCommande->execute();
        $allCommande = $getAllCommande->fetchAll();

        return $allCommande;
    }


    //Methode pour selectionner toute les commandes 

    public function SelectAllCommandesByUSer($idUser)
    {
        $sql = "SELECT  utilisateurs.login,commandes.id,commandes.numero,commandes.id_adresse,commandes.date, historiques_panier.quantite,produits.nom,produits.prix 
        FROM commandes 
        JOIN historiques_panier ON commandes.id = historiques_panier.id_commande 
        JOIN produits ON produits.id = historiques_panier.id_produit 
        JOIN utilisateurs ON utilisateurs.id = commandes.id_utilisateur WHERE commandes.id_utilisateur = ?";
        $getAllCommande = $this->bdd->prepare($sql);
        $getAllCommande->execute([$idUser]);
        $allCommande = $getAllCommande->fetchAll();

        return $allCommande;
    }
}
?>