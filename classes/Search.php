
<?php

require '../classes/Bdd.php';

class Search extends Bdd

{
    private $id;


    public function __Construct()
    {

        parent::__construct();
    }



    //  Methode pour chercher un produit dans la barre de recherche 
    public function SearchProduct($search)
    {

        $sql = "SELECT produits.nom AS nomProduit, produits.image FROM produits JOIN sous_categorie ON sous_categorie.id = produits.id_sous_categorie
        WHERE  produits.nom LIKE ? 
        OR 
          sous_categorie.nom LIKE ? ";
        $searchCommande = $this->bdd->prepare($sql);
        $searchCommande->execute(['%'.$search.'%','%'.$search.'%']);
        $search = $searchCommande->fetchAll(PDO::FETCH_ASSOC);
    
        $searchJSON= json_encode($search);

       echo $searchJSON;

    }


   
}

$search = new Search();

$search->SearchProduct('burger');