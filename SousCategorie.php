<?php

class SousCategorie
{
    //Attributs
    private $bdd;


    //Méthodes
    public function __construct()
    {
        $this->bdd = new PDO('mysql:host=localhost; dbname=boutique-en-ligne', 'root', ''); //Connexion à la bdd
        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getLesSousCategories()
    {
        $req = " SELECT souscategories.id, 
                        souscategories.nom,
                        categories.nom AS categorie,
                        idCategorie
                FROM   souscategories
                INNER JOIN categories
                ON souscategories.idCategorie = categories.id";
        $query = $this->bdd->prepare($req);
        $query->execute();
        return $query->fetchAll();
    }
    public function ajouterSousCategorie($nom, $idCategorie)
    {
        $req = "INSERT INTO souscategories(nom, idCategorie)
               VALUES(:nom, :idCategorie)";
        $query = $this->bdd->prepare($req);
        $query->execute([
            ":nom" => $nom,
            ":idCategorie" => $idCategorie]);
    }
    public function supprimerSousCategorie($id)
    {
        $req =  "DELETE FROM souscategories
                WHERE id = :id";
        $query = $this->bdd->prepare($req);
        $query->execute([
            ":id" => $id
        ]);

    }
    public function getCategorieParId($id)
    {
        $req = " SELECT souscategories.id, 
                        souscategories.nom,
                        categories.nom AS categorie,
                        idCategorie
                FROM   souscategories
                INNER JOIN categories
                ON souscategories.idCategorie = categories.id
                WHERE id = :id";
        $query = $this->bdd->prepare($req);
        $query->execute([
               ":id" => $id
        ]);
        return $query->fetch();
    }
}
