<?php


class Panier extends Bdd

{
    private $id;
    public $nom;

    public function __Construct($nom)
    {

        parent::__construct();
        $this->nom = $nom;

        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }
    }

   

//  Methode pour ajouter des produits au panier
public function addPanier($id_produit)
{  
    
        $_SESSION['panier'][$id_produit]=1;
    
   
}
}
