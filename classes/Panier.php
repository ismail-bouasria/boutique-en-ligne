<?php


class Panier extends Bdd

{
    private $id;


    public function __Construct()
    {

        parent::__construct();
    }



    //  Methode pourajouter des produits au panier
    public function addPanier($quantite, $idProduit, $idUser)
    {
        $sql = "INSERT INTO `panier`(`quantite`,`id_produit`, `id_utilisateur`) VALUES (?,?,?)";
        $addPanier = $this->bdd->prepare($sql);
        $addPanier->execute([$quantite, $idProduit, $idUser]);
    }



    //  Methode pour modifier la quantite  si l'article existe déjà dans le panier
    public function addOneMoreProduit($quantite, $idProduit, $idUser)
    {
        $sql = "UPDATE `panier` SET `quantite` = quantite + ? WHERE `id_produit`= ? AND `id_utilisateur`= ? ";
        $getProduitPanier = $this->bdd->prepare($sql);
        $getProduitPanier->execute([$quantite,$idProduit,$idUser]);
       

    }



     //  Methode pour modifier la quantite des article déjà dans le panier
     public function updatePanier($quantite, $idProduit, $idUser)
     {
         $sql = "UPDATE `panier` SET `quantite`= ? WHERE `id_produit`= ? AND `id_utilisateur`= ? ";
         $getProduitPanier = $this->bdd->prepare($sql);
         $getProduitPanier->execute([$quantite,$idProduit,$idUser]);
        
 
    }



    // Methode pour compter le total prix 

    public function totalPrix ($id) {

        $sql = "SELECT COUNT(*) AS `produit` FROM `panier` WHERE `id_utilisateur`= ?";
        $countProduit = $this->bdd->prepare($sql);
        $countProduit->execute([$id]);
        $count = $countProduit->fetch();
       
        return $count['produit'];

    }

     // Methode pour savoir si le produit dans le panier est encore en stock 

     public function countstock($id,$idProduct) {

        $sql = "SELECT produits.stock FROM produits INNER JOIN panier ON produits.id = panier.id_produit WHERE panier.id_utilisateur = ? AND produits.id = ?";
        $countStock = $this->bdd->prepare($sql);
        $countStock->execute([$id, $idProduct]);
        $stock = $countStock->fetch();
       
        return $stock[0];

    }


    // Methode pour compter le nombre d'article 

    public function countProduit ($id) {

        $sql = "SELECT COUNT(*) AS `produit` FROM `panier` WHERE `id_utilisateur`= ?";
        $countProduit = $this->bdd->prepare($sql);
        $countProduit->execute([$id]);
        $count = $countProduit->fetch();
       
        return $count['produit'];

    }

     // Methode pour compter la somme du prix 

    public function sumPrix ($id) {

    $sql = "SELECT SUM(panier.quantite*produits.prix) AS `prix` FROM `panier` JOIN `produits` ON panier.id_produit = produits.id WHERE panier.id_utilisateur=?";
    $sumPrix = $this->bdd->prepare($sql);
    $sumPrix->execute([$id]);
    $sum = $sumPrix->fetch();
   
    return $sum['prix'];

}

 // Methode pour compter la somme des produits

 public function sumProduit ($id) {

    $sql = "SELECT SUM(quantite) AS `produit` FROM `panier` WHERE `id_utilisateur`= ?";
    $sumProduit = $this->bdd->prepare($sql);
    $sumProduit->execute([$id]);
    $sum = $sumProduit->fetch();
   
    return $sum['produit'];

}


//  Methode pour recuperer le nom des produits ajouté panier
    public function getProduitPanier($idProduit, $idUser)
    {
        $sql = "SELECT
        produits.nom
         FROM `produits`
         JOIN `panier`
         ON panier.id_produit = produits.id
        WHERE produits.id = ? AND `id_utilisateur`= ? ";
        $getProduitPanier = $this->bdd->prepare($sql);
        $getProduitPanier->execute([$idProduit, $idUser]);
        $getProduit= $getProduitPanier->fetch();

        return $getProduit;

    }



    //  Methode pour montrer des produits dans le panier  panier
    public function showProduitPanier($id){
        $sql = "SELECT panier.id,
         panier.quantite,
         produits.image,produits.nom,produits.id,produits.description,produits.prix,produits.stock
         FROM `panier`
         JOIN `produits`
         ON panier.id_produit = produits.id
        WHERE panier.id_utilisateur =?";
        $addPanier = $this->bdd->prepare($sql);
        $addPanier->execute([$id]);
        $panier = $addPanier->fetchAll();

        return $panier;
    }


    //  Methode pour supprimer des produits dans le panier  
    public function deleteProduitPanier($idUser,$idProduit){
        $sql = "DELETE FROM `panier` WHERE `id_utilisateur`=? AND `id_produit`=?";
        $addPanier = $this->bdd->prepare($sql);
        $addPanier->execute([$idUser,$idProduit]);
        $panier = $addPanier->fetchAll();

        return $panier;
    }
}
