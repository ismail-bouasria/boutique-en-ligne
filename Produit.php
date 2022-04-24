<?php
require 'Bdd.php';
class Produit extends Bdd
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getLesProduits()
    {
        $req = " SELECT produits.id,
                        produits.nom,
                        description,
                        prix,
                        stock,
                        categories.nom AS categorie
                 FROM   produits
                 INNER JOIN categories
                 ON produits.idCategorie = categories.id";
        $query = $this->bdd->prepare($req);
        $query->execute();
        return $query->fetchAll();
    }
    public function ajouterProduit($nom, $description, $prix, $stock, $categorie)
    {
        $req = "INSERT INTO produits(nom, description, prix, stock, idCategorie)
               VALUES(:nom, :description, :prix, :stock, :categorie)";
        $query = $this->bdd->prepare($req);
        $query->execute([
            ":nom" => $nom,
            ":description" => $description,
            ":prix" => $prix,
            ":stock" => $stock,
            ":categorie" => $categorie
        ]);
    }
    public function supprimerProduit($id)
    {
        $req =  "DELETE FROM produits
                WHERE id = :id";
        $query = $this->bdd->prepare($req);
        $query->execute([
            ":id" => $id
        ]);
    }
}
