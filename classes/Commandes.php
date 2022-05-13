<?php


class Commandes extends Bdd

{
    private $id;


    public function __Construct()
    {

        parent::__construct();
    }



    //  Methode pour enregister des commandes au panier;
    public function insertCommandes($numero, $idUser, $idPanier)
    {
        $sql = "INSERT INTO `commandes`(`numero`, `id_utilisateur`, `id_panier`, ) VALUES (?,?,?)";
        $addPanier = $this->bdd->prepare($sql);
        $addPanier->execute([$numero, $idUser, $idPanier]);
    }



    public function selectAllcommandes () {

        $sql = "SELECT commandes.numero, produits.nom,produits.prix, panier.quantite, utilisateurs.login,utilisateurs.email 
        FROM `commandes` JOIN `panier` ON commandes.id_panier = panier.id 
        JOIN `produits` ON panier.id_produit = produits.id 
        JOIN `utilisateurs` ON commandes.id_utilisateur = utilisateurs.id";
        $selectAll = $this->bdd->prepare($sql);
        $selectAll->execute();
        $selectAllcommandes = $selectAll->fetchAll();
       
        return $selectAllcommandes;
    
    }
   

    public function selectAllById($id) {

        $sql = "SELECT commandes.numero, produits.nom,produits.prix, panier.quantite 
        FROM `commandes` JOIN `panier` ON commandes.id_panier = panier.id 
        JOIN `produits` ON panier.id_produit = produits.id WHERE commandes.id_utilisateur = ?";
        $selectAll = $this->bdd->prepare($sql);
        $selectAll->execute([$id]);
        $selectAllcommandes = $selectAll->fetchAll();
       
        return $selectAllcommandes;
    
    }
   








    //  Methode pour montrer des produits dans le panier  panier
    public function deleteProduitPanier($idUser,$idProduit){
        $sql = "DELETE FROM `panier` WHERE `id_utilisateur`=? AND `id_produit`=?";
        $addPanier = $this->bdd->prepare($sql);
        $addPanier->execute([$idUser,$idProduit]);
        $panier = $addPanier->fetchAll();

        return $panier;
    }
}
