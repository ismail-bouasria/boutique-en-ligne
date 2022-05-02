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

        $req =  "SELECT produits.id,
                        produits.nom,
                        description,
                        prix,
                        stock,
                        idSousCategorie,
                        categories.nom AS categorie,
                        categories.id AS idCategorie,
                        souscategories.nom AS sousCategorie
                    FROM  produits
                    INNER JOIN souscategories
                    ON   produits.idSousCategorie = souscategories.id
                    INNER JOIN categories
                    ON souscategories.idCategorie = categories.id";
        $query = $this->bdd->prepare($req);
        $query->execute([]);
        return $query->fetchAll();
    }
    public function ajouterProduit($nom, $description, $prix, $stock, $categorie)
    {
        $req = "INSERT INTO produits(nom, description, prix, stock, idSousCategorie)
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

    public function getUnProduit($idProduit)
    {
        $req = "SELECT * 
                FROM produits 
                WHERE id = :id";
        $query = $this->bdd->prepare($req);
        $query->execute([
            ":id" => $idProduit
        ]);

        return $query->fetch();
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
    public function getUnProduitParIdCategorie($idCategorie)
    {
        $req =      "SELECT produits.id,
                            produits.nom,
                            description,
                            prix,
                            stock,
                            idSousCategorie,
                            categories.id AS idCategorie,
                            categories.nom AS categorie, 
                            souscategories.nom AS sousCategorie
                    FROM  produits
                    INNER JOIN souscategories
                    ON   produits.idSousCategorie = souscategories.id
                    INNER JOIN categories
                    ON souscategories.idCategorie = categories.id
                 WHERE idCategorie = :id";

        $query = $this->bdd->prepare($req);
        $query->execute([
            ":id" => $idCategorie
        ]);
        return $query->fetchAll();
    }
}
