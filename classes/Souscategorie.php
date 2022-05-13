<?php


class SousCategorie extends Bdd

{
    private $id;
    public $nom;

    public function __Construct($nom)
    {
        parent::__construct();
        $this->nom = $nom;
    }


    //  Methode pour récuperer les infos de la sous categorie selon l'id de la catégorie
 public function getAllSousCategorie($id,$firstcat,$bycat)
 {
     $sql = 'SELECT * FROM `sous_categorie`WHERE `id_categorie`= :id LIMIT :firstcat,:bycat';

     $getAllSousCategorie = $this->bdd->prepare($sql);

     $getAllSousCategorie->bindValue(':id', (int) $id, PDO::PARAM_INT);
     $getAllSousCategorie->bindValue(':firstcat', (int) $firstcat, PDO::PARAM_INT);
     $getAllSousCategorie->bindValue(':bycat', (int) $bycat, PDO::PARAM_INT);
     $getAllSousCategorie->execute();
     $getSousCategorie = $getAllSousCategorie->fetchAll();
     return $getSousCategorie;
 }

   //  Methode pour récuperer les infos de toutes les sous categories
   public function getAllSousCategorie2()
   {
       $sql = 'SELECT sous_categorie.nom 
       AS sousnom,sous_categorie.id AS souscatid, categories.nom 
       AS categoriesnom, categories.id AS catid FROM `sous_categorie`
       INNER JOIN categories ON sous_categorie.`id_categorie` = categories.id';
  
       $getAllSousCategorie = $this->bdd->prepare($sql);
       $getAllSousCategorie->execute();
       $getSousCategorie = $getAllSousCategorie->fetchAll();
       return $getSousCategorie;
   }
  



   //  Methode pour récuperer le nombre de sous-categorie 
   public function nb_SousCategories($id_categorie)
   {
       $sql= 'SELECT COUNT(*) AS nb_sous_categories FROM sous_categorie WHERE `id_categorie`=?';
       $nb_SousCategorie = $this->bdd->prepare($sql);
       $nb_SousCategorie->execute([$id_categorie]);
       $nb_SousCat= $nb_SousCategorie->fetch();
        
       return $nb_SousCat= (int) $nb_SousCat['nb_sous_categories'];
   }




    //  Methode pour trouver le nom d'une catégorie'
    public function getNameSousCategorie($nom)
    {
        $getSousNameCategorie = $this->bdd->prepare("SELECT  `nom`  FROM `Sous_categorie` WHERE nom = ?");
        $getSousNameCategorie->execute([$nom]);
        $getName = $getSousNameCategorie->fetch();
        return $getName;
    }
    //  Methode pour ajouter une catégorie'
    public function addSousCategorie($nom, $idCategorie)
    {
        $addCategorie = $this->bdd->prepare(" INSERT INTO `sous_categorie`(`nom`, `id_categorie`) VALUES (?,?)");
        $addCategorie->execute([$nom, $idCategorie]);
    }




    // Méthode pour récuperer le nom et l'id des categorie
    public function selectAllSousCategorie()
    {

        $getAll = $this->bdd->prepare("SELECT * FROM sous_categorie");
        $getAll->execute();
        $getAllSousCategorie = $getAll->fetchAll();
        foreach ($getAllSousCategorie as $value) {
            echo '<option value="' . $value['id'] . '">' . $value['nom'] . '</option>';
        }
    }



    // Méthode pour delete des sous-categories
 public function deleteSousCategorie($id)
 {
     $sql = "DELETE FROM `sous_categorie` WHERE  `id`=?";
     $deleteCat = $this->bdd->prepare($sql);
     $deleteCat->execute([$id]);
    
 }

}

 