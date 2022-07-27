
<?php

require '../classes/Bdd.php';

class Search extends Bdd

{


    public function __Construct()
    {

        parent::__construct();
    }



    //  Methode pour chercher un produit dans la barre de recherche 
    public function SearchProduct($search)
    {

        $sql = "SELECT produits.* , produits.nom AS nomProduit, produits.image FROM produits JOIN sous_categorie ON sous_categorie.id = produits.id_sous_categorie
        WHERE  produits.nom LIKE ?  ";
        $searchCommande = $this->bdd->prepare($sql);
        $searchCommande->execute(['%'.$search.'%']);
        $search = $searchCommande->fetchAll(PDO::FETCH_ASSOC);
    
        $searchJSON= json_encode($search);

       echo $searchJSON;

    }


   
}

if(isset($_GET['search'])){
    $searchKey = htmlentities($_GET['search']);
    $search = new Search;
    $search->SearchProduct($searchKey);
}
