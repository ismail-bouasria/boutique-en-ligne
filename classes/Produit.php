<?php
require 'Bdd.php';

class Produit extends Bdd
{
    public function __construct()
    {
        parent::__construct();
    }


    //  Methode pour importer les infos des produits lajouter au panier
    public function getAllProduitPanier($id)
    {
        $sql = 'SELECT * FROM `produits` WHERE `id` IN (?)';

        $getAllProduit = $this->bdd->prepare($sql);
        $getAllProduit->execute([$id]);
        $getAllProduitPanier = $getAllProduit->fetchAll();
        return $getAllProduitPanier;
    }


    //  Methode pour récuperer les infos des produits lajouter au panier
    public function getIdProduitPanier($id)
    {
        $sql = 'SELECT id FROM `produits` WHERE `id`= ?';

        $getIdProduit = $this->bdd->prepare($sql);
        $getIdProduit->execute([$id]);
        $getId = $getIdProduit->fetchAll();
        return $getId;
    }

    //  Methode pour updatele la catégorie'
    public function updateProduit($image, $nom, $description, $prix, $stock, $idSousCat, $id)

    {

        $sql = "UPDATE `produits` SET `image`= ?,`nom`= ?,`description`= ? ,`prix`= ? ,`stock`= ? ,`id_sous_categorie`= ? WHERE `id`= ?";
        $updateProduit = $this->bdd->prepare($sql);
        $updateProduit->execute([ $image, $nom, $description, $prix, $stock, $idSousCat, $id]);
    }


    //  Methode pour trouver les informations de tous les produits
    public function getAllProductsByID($id)
    {
        $sql = "SELECT * FROM `produits` WHERE id_sous_categorie = ?";
        $getAllProducts = $this->bdd->prepare($sql);
        $getAllProducts->execute([$id]);
        return $getAllProducts->fetchAll();
    }



    //  Methode pour trouver les informations de tous les produits
    public function getAllProductsByIDSous($id)
    {
        $sql = "SELECT * FROM `produits` WHERE id = ?";
        $getAllProducts = $this->bdd->prepare($sql);
        $getAllProducts->execute([$id]);
        return $getAllProducts->fetch();
    }


    // Méthode pour récuperer le s informations des produits

    public function getAllProduitById($id)
    {

        $getAll = $this->bdd->prepare("SELECT produits.*, sous_categorie.id AS id_souscat, sous_categorie.nom AS nom_souscat
        FROM produits
        INNER JOIN sous_categorie ON sous_categorie.id = produits.id_sous_categorie
        WHERE produits.id= ? ");
        $getAll->execute([$id]);
        $getAllProduit = $getAll->fetchAll();

        return $getAllProduit;
    }


    //  Methode pour trouver le nom d'une catégorie'
    public function getNameProduct($nom)
    {
        $getNameProduct = $this->bdd->prepare("SELECT  `nom`  FROM `produits` WHERE nom = ?");
        $getNameProduct->execute([$nom]);
        $getName = $getNameProduct->fetch();
        return $getName;
    }


    //  Methode pour ajouter les informations du produits dans la bdd
    public function addProduct($image, $nom, $description, $prix, $stock, $categorie)
    {
        $sql = "INSERT INTO produits( image,nom, description, prix, stock, id_sous_categorie)
               VALUES(?, ?, ?,?,?,?)";
        $addProduct = $this->bdd->prepare($sql);
        $addProduct->execute([$image, $nom, $description, $prix, $stock, $categorie]);
    }


  // Methode pour savoir si le produit dans le panier est encore en stock 

    public function countstock($idProduct) {

    $sql = "SELECT `stock` FROM `produits` WHERE `id`= ?";
    $countStock = $this->bdd->prepare($sql);
    $countStock->execute([$idProduct]);
    $stock = $countStock->fetch();
   
    return $stock;

}


    public function deleteProduit($id)
    {
        $sql =  "DELETE FROM produits
                WHERE id = ? ";
        $deleteProduct = $this->bdd->prepare($sql);
        $deleteProduct->execute([$id]);
    }


    //  Methode pour trouver les informations de tous les produits
    public function getAllProducts()
    {
        $sql = "SELECT * FROM `produits` ORDER BY RAND () LIMIT 4";
        $getAllProducts = $this->bdd->prepare($sql);
        $getAllProducts->execute();
        return $getAllProducts->fetchAll();
    }



    //  Methode pour trouver les informations de tous les produits
    public function getListingProducts()
    {
        $sql = "SELECT * FROM `produits`";
        $getAllProducts = $this->bdd->prepare($sql);
        $getAllProducts->execute();
        return $getAllProducts->fetchAll();
    }

    //  Methode pour trouver les informations des 3 derniers produits
    public function lastProduct()
    {
        $sql = "SELECT * FROM `produits` ORDER BY `id` DESC LIMIT 3";
        $getLastProducts = $this->bdd->prepare($sql);
        $getLastProducts->execute();
        return $getLastProducts->fetchAll();
    }

    //  Methode pour trouver les informations des 3  produits les plus acheter
    public function famousProduct()
    {
        $sql = "SELECT produits.*, commandes.*,historiques_panier.* FROM `produits` 
        JOIN historiques_panier ON produits.id = historiques_panier.id_produit 
        JOIN commandes ON commandes.id =historiques_panier.id_commande 
        WHERE commandes.etat='off' ORDER BY historiques_panier.quantite DESC LIMIT 3";
        $getLastProducts = $this->bdd->prepare($sql);
        $getLastProducts->execute();
        return $getLastProducts->fetchAll();
    }


    //  Methode pour modifier le stock des produits dans le panier 
    public function UpdateStockProducts($quantite,$idProduct)
    {
        $sql = "UPDATE `produits` SET `stock`= (`stock`- ?) WHERE `id` = ?";
        $getAllProducts = $this->bdd->prepare($sql);
        $getAllProducts->execute([$quantite,$idProduct]);
        return $getAllProducts->fetchAll();
    }
}
