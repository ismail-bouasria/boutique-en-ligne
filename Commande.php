<?php
require("Bdd.php");
class Commande extends Bdd
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ajouterCommande($numero)
    {
        $req = "INSERT INTO commandes (numero)
                VALUES (:numero)";
        $query = $this->bdd->prepare($req);
        $query->execute([
            ":numero" => $numero
        ]);
        return $this->getUneCommandeParNumero($numero);
    }

    public function getUneCommandeParNumero($numero)
    {
        $req = "SELECT * FROM commandes WHERE numero = :numero";
        $query = $this->bdd->prepare($req);
        $query->execute([
            ":numero" => $numero
        ]);
        return $query->fetch();
    }

    public function ajouterUneLigneCommande($idProduit, $idUtilisateur, $idCommande, $quantite)
    {
        try {
            $req = "INSERT INTO ligne_commande (idProduit, 
                                idUtilisateur, 
                                idCommande,
                                quantite)
                    VALUES      (:idProduit,
                                :idUtilisateur,
                                :idCommande,
                                :quantite)";
            $query = $this->bdd->prepare($req);
            $query->execute([
                "idProduit"     => $idProduit,
                "idUtilisateur" => $idUtilisateur,
                "idCommande"    => $idCommande,
                "quantite"      => $quantite,
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
