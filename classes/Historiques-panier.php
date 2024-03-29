<?php


class HistoriquePanier extends Bdd

{
    private $id;


    public function __Construct()
    {

        parent::__construct();
    }



    //  Methode pour ajouter des produits à l'historique 
    public function addHistoriquePanier($quantite, $idProduit, $idCommande)
    {
        $sql = "INSERT INTO `historiques_panier`(`quantite`,`id_produit`, `id_commande`) VALUES (?,?,?)";
        $addHistoriquePanier = $this->bdd->prepare($sql);
        $addHistoriquePanier->execute([$quantite, $idProduit, $idCommande]);
    }



    //  Methode pour modifier la quantite  si l'article existe déjà dans l'historique
    public function addOneMoreHistorique($quantite, $idProduit, $idCommande)
    {
        $sql = "UPDATE `historiques_panier` SET `quantite` = quantite + ? WHERE `id_produit`= ? AND `id_commande`= ? ";
        $getProduitPanier = $this->bdd->prepare($sql);
        $getProduitPanier->execute([$quantite,$idProduit,$idCommande]);
       

    }


     //  Methode pour modifier la quantite des article déjà dans l'historique'
     public function updateHistorique($quantite, $idProduit, $numero)
     {
         $sql = "UPDATE `historiques_panier` SET `quantite`= ? WHERE `id_produit`= ? AND `id_commande`= ? ";
         $getProduitPanier = $this->bdd->prepare($sql);
         $getProduitPanier->execute([$quantite,$idProduit,$numero]);
        
 
    }


    // Methode pour compter le total prix 

    public function totalPrix ($id) {

        $sql = "SELECT COUNT(*) AS `total` FROM `historiques_panier` WHERE `id_commande`= ?";
        $countProduit = $this->bdd->prepare($sql);
        $countProduit->execute([$id]);
        $count = $countProduit->fetch();
       
        return $count['total'];

    }



    // Methode pour compter le nombre d'article 

    public function countProduit ($id) {

        $sql = "SELECT COUNT(*) AS `produit` FROM `historique_panier` WHERE `id_utilisateur`= ?";
        $countProduit = $this->bdd->prepare($sql);
        $countProduit->execute([$id]);
        $count = $countProduit->fetch();
       
        return $count['produit'];

    }

     // Methode pour compter la somme du prix 

    public function sumPrix ($id) {

    $sql = "SELECT SUM(historiques_panier.quantite*produits.prix) AS `prix` 
    FROM `historiques_panier` JOIN `produits` ON historiques_panier.id_produit = produits.id 
    WHERE historiques_panier.id_commande=?";
    $sumPrix = $this->bdd->prepare($sql);
    $sumPrix->execute([$id]);
    $sum = $sumPrix->fetch();
   
    return $sum['prix'];

}

 // Methode pour compter la somme des produits

 public function sumProduit ($id) {

    $sql = "SELECT SUM(quantite) AS `produit` FROM `historiques_panier` WHERE `id_commande`= ?";
    $sumProduit = $this->bdd->prepare($sql);
    $sumProduit->execute([$id]);
    $sum = $sumProduit->fetch();
   
    return $sum['produit'];

}


//  Methode pour recuperer le nom des produits ajouté panier
    public function getProduitHistorique($idProduit, $idUser)
    {
        $sql = "SELECT
        produits.nom
         FROM `produits`
         JOIN `historiques_panier`
         ON historiques_panier.id_produit = produits.id
        WHERE produits.id = ? AND `id_commande`= ? ";
        $getProduitHistorique = $this->bdd->prepare($sql);
        $getProduitHistorique->execute([$idProduit, $idUser]);
        $getHistorique= $getProduitHistorique->fetch();

        return $getHistorique;

    }



   


    //  Methode pour montrer des produits dans le panier  panier
    public function deleteProduitHistorique($idNumero,$idProduit){
        $sql = "DELETE FROM `historiques_panier` WHERE `id_commande`=? AND `id_produit`=?";
        $addPanier = $this->bdd->prepare($sql);
        $addPanier->execute([$idNumero,$idProduit]);
        $panier = $addPanier->fetchAll();

        return $panier;
    }
}
