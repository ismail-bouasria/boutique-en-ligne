<?php

class Categorie
{
    //Attributs
    private $bdd;


    //Méthodes
    public function __construct()
    {
        $this->bdd = new PDO('mysql:host=localhost; dbname=boutique-en-ligne', 'root', ''); //Connexion à la bdd
        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getLesCategories()
    {
        $req = " SELECT id, nom
             FROM   categories";
        $query = $this->bdd->prepare($req);
        $query->execute();
        return $query->fetchAll();
    }
    public function ajouterCategorie($nom)
    {
        $req = "INSERT INTO categories(nom)
               VALUES(:nom)";
        $query = $this->bdd->prepare($req);
        $query->execute([
            ":nom" => $nom
        ]);
    }
    public function supprimerCategorie($id)
    {
        $req =  "DELETE FROM categories
                WHERE id = :id";
        $query = $this->bdd->prepare($req);
        $query->execute([
            ":id" => $id
        ]);

    }
    public function getCategorieParId($id)
    {
        $req = "SELECT * 
                FROM categories
                WHERE id = :id";
        $query = $this->bdd->prepare($req);
        $query->execute([
               ":id" => $id
        ]);
        return $query->fetch();
    }
}
