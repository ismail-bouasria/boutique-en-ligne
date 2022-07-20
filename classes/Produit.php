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
}
