<?php
require 'Bdd.php';

class Droit extends Bdd

{
    private $id;
    public $nom;

    public function __construct($nom)
    {
        parent::__construct();
        $this->nom = $nom;
    }


    //  Methode pour récuperer les droits
    public function getDroit($nom)
    {
        $sql = " SELECT `id` FROM `droits` WHERE nom=?";
        $getDroit = $this->bdd->prepare($sql);
        $getDroit->execute([$this->nom]);
        $Droit = $getDroit->fetch();

        return $getDroit['id'];
    }
}

// $droit = new Droit('');
// $droit->getDroit('administrateur')
