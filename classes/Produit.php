<?php
require 'Bdd.php';

class Produit extends Bdd
{
    public function __construct()
    {
        parent::__construct();
    }



    //  Methode pour trouver le nom d'un produit
    public function getNameProduct($nom)
    {
        $getNameProduct = $this->bdd->prepare("SELECT  `nom`  FROM `produits` WHERE nom = ?");
        $getNameProduct->execute([$nom]);
        $getName = $getNameProduct->fetch();
        return $getName;
    }


    //  Methode pour trouver les informations de tous les produits
    public function getAllProductsByID($id)
    {
        $sql = "SELECT * FROM `produits` WHERE id_sous_categorie = ?";
        $getAllProducts = $this->bdd->prepare($sql);
        $getAllProducts->execute([$id]);
        return $getAllProducts->fetchAll();
    }


    public function addProduct($image, $nom, $description, $prix, $stock, $categorie)
    {
        $sql = "INSERT INTO produits( image,nom, description, prix, stock, id_sous_categorie)
               VALUES(?, ?, ?,?,?,?)";
        $addProduct = $this->bdd->prepare($sql);
        $addProduct->execute([$image, $nom, $description, $prix, $stock, $categorie]);
    }


    public function deleteProduct($id)
    {
        $sql =  "DELETE FROM produits
                WHERE id = '?'";
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
}
