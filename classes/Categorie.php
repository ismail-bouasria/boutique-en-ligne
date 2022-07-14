<?php


class Categorie extends Bdd

{
    private $id;
    public $nom;

    public function __Construct($nom)
    {
        parent::__construct();
        $this->nom = $nom;
    }





    //  Methode pour trouver recuperer les informations d'une catégorie'
    public function getAllCategorie()
    {
        $getAllCategorie = $this->bdd->prepare("SELECT * FROM categories");
        $getAllCategorie->execute();
        $getAll = $getAllCategorie->fetchAll();
        return $getAll;
    }


    //  Methode pour trouver le nom d'une catégorie'
    public function getNameCategorie($nom)
    {
        $getNameCategorie = $this->bdd->prepare("SELECT  `nom`  FROM `categories` WHERE nom = ?");
        $getNameCategorie->execute([$nom]);
        $getName = $getNameCategorie->fetch();
        return $getName;
    }


    //  Methode pour ajouter une catégorie'
    public function addCategorie($nom, $image)
    {
        $addCategorie = $this->bdd->prepare(" INSERT INTO `categories`(`nom`, `image`) VALUES (?,?)");
        $addCategorie->execute([$nom, $image]);
    }
    //  Methode pour récuperer le nom selon l'id de la catégorie'
    public function getCategorie($id)
    {
        $getCategorie = $this->bdd->prepare(" SELECT `nom` FROM `categories` WHERE id=?");
        $getCategorie->execute([$id]);
        $getCategorie = $getCategorie->fetch();

        return $getCategorie['nom'];
    }


    //  Methode pour récuperer le 'id selon l'id de la catégorie'
    public function getCategorieId($id)
    {
        $getCategorieId = $this->bdd->prepare("SELECT `id` FROM `categories` WHERE id=?");
        $getCategorieId->execute([$id]);
        $getIdCategorie = $getCategorieId->fetch();

        return $getIdCategorie['id'];
    }


    // Méthode pour récuperer le nom et l'id des categorie
    public function selectAllCategorie()
    {

        $getAll = $this->bdd->prepare("SELECT * FROM categories");
        $getAll->execute();
        $getAllCategorie = $getAll->fetchAll();
        foreach ($getAllCategorie as $value) {
            echo '<option value="' . $value['id'] . '">' . $value['nom'] . '</option>';
        }
    }

    // Méthode pour delete des categorie
    public function deleteCategorie($id)
    {
        $sql = "DELETE FROM `categories` WHERE  `id`=?";
        $deleteCat = $this->bdd->prepare($sql);
        $deleteCat->execute([$id]);
       
    }


    // Méthode pour récuperer le nom et les liens des categorie
    public function selectAllLinkCategorie()
    {

        $getAll = $this->bdd->prepare("SELECT * FROM categories");
        $getAll->execute();
        $getAllLink = $getAll->fetchAll();
        foreach ($getAllLink as $value) {
            echo '<a class="dropdown-item" href="categorie-produit.php?categorie=' . $value['id'] . '">' . $value['nom'] . '</a>';
        }
    }
}
