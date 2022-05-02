<?php
session_start();

require("../Produit.php");
require("../Categorie.php");

$produit = new Produit();
$categorie = new Categorie();

/**
 * Si le paramètre start n'existe pas dans la requête, 
 * alors nous redirigons l'utilisateur au même endroit avec le paramètre
 * start initialisé à 0
 * 
 * $_SERVER["REQUEST_URI"] correspond à l'URL sur laquelle nous sommes actuellement
 * 
 */
if (!isset($_REQUEST["start"])) {
    header("Location:" . $_SERVER["REQUEST_URI"] . "&start=0");
}

$laCategorie                    = $categorie->getCategorieParId($_REQUEST["idCategorie"]);
$lesProduits                    = $produit->getUnProduitParIdCategorie($laCategorie["id"]);
/**
 * On stocke dans $start la valeur entière du paramètre 
 * start de la requête avec la fonction intval()
 */
$start                          = intval($_REQUEST["start"]);

$decalage                       = 5;

/**
 * Pour déduire le nombre de page, on divise le nombre d'articles (count($lesProduits))
 * par le nombre d'article que l'on veut par page ($decalage)
 * 
 * On arrondi le resultat à l'entier supérieur à l'aide de la fonction ceil()
 */
$nombreDePage                   = ceil(count($lesProduits) / $decalage);

/**
 * la fonction array_slice() permet de tronquer (découper une partie) un tableau
 * Elle prend paramètre le tableau en question,
 * le point de depart dans la tableau 
 * ainsi que la longueur (en element) à prendre
 * 
 * Elle renvoie un tableau avec les elements compris 
 * entre le point de départ et le point de départ + la longueur
 * 
 */
$lesProduitsTronques            = array_slice($lesProduits, $start, $decalage);
$lesProduitsTronquesSuivants    = array_slice($lesProduits, $start + $decalage, $start + ($decalage * 2));
$lesProduitsTronquesPrecedents  = array_slice($lesProduits, $start - $decalage, $start);
$lesProduits                    = $lesProduitsTronques;


if (isset($_REQUEST["action"]) && $_REQUEST["action"] === "ajouterPanier") {
    $idProduit = $_REQUEST["id"];

    if (empty($_SESSION["panier"])) {
        $_SESSION["panier"] = [];
    }

    array_push($_SESSION["panier"], $idProduit);

    var_dump($_SESSION["panier"]);
}
include('../require/header.php');
?>
<?php if (isset($_REQUEST["controleur"]) && isset($_REQUEST["action"]) && !empty($lesProduits)) : ?>
    <h1 class="text-center fs-1 mt-5">
        <?= $laCategorie["nom"] ?>
    </h1>
<?php elseif (empty($lesProduits)) : ?>
    <div id="echec" class="container rounded mt-2 text-center fw-bold">
        <div class="row">
            <ul class="list-group col-md-8 col-12 mx-auto">
                <li class="list-group-item list-group-item-danger">
                    <i class="fas fa-exclamation-circle text-danger"></i> Aucun article n'est disponible pour l'instant. Veuillez revenir plus tard !
                </li>
            </ul>
        </div>
    </div>
<?php endif; ?>
<div class="container-fluid">
    <div class="row justify-content-around mt-5">
        <?php foreach ($lesProduits as $key => $unProduit) : ?>
            <div class="card col col-lg-6 m-5 col-md-6 col-sm-10 border border-dark border-2 bg-body rounded w-25">
                <img src="../assets/img/sandwith.jpg" class="card-img-top rounded mt-2">
                <div class="card-body">
                    <h5 class="card-title"> <?= $unProduit["nom"] ?> </h5>
                    <p class="card-text">
                        <span>
                            <?= substr($unProduit["description"], 0, 50) ?>
                        </span>
                        <span>
                            <a href="" class="text-decoration-none">Lire la suite...</a>
                        </span>
                    </p>
                </div>
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item">
                        <span class="fw-bold">
                            Categorie
                        </span>
                        <span>
                            <?= $unProduit["categorie"] ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">
                            Prix
                        </span>
                        <span>
                            <?= number_format((float)$unProduit["prix"], 2, '.', '')  . "€" ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">
                            Quantité restante
                        </span>
                        <span>
                            <?= $unProduit["stock"] ?>
                        </span>
                    </li>
                </ul>
                <div class="d-flex justify-content-center m-2">
                    <button class="btn btn-success">
                        <a href="lesProduits.php?action=ajouterPanier&start=<?= isset($_REQUEST["start"]) ? $_REQUEST["start"] : "" ?>&id=<?= $unProduit["id"] ?>&idCategorie=<?= $unProduit["idCategorie"] ?>" class="text-decoration-none">
                            Ajouter au panier
                        </a>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if (isset($_REQUEST["start"])) : ?>
        <div class="d-flex justify-content-around">
            <div>
                <?php if (!empty(count($lesProduitsTronquesPrecedents))) : ?>
                    <div class="text-center">
                        <a href="index.php?controleur=article&action=liste&idCategorie=<?= $laCategorie["id"] ?>&start=<?= $start - $decalage ?>" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Precedent </a>
                    </div>
                <?php endif; ?>
            </div>
            <div>
                <div class="d-flex justify-content-center">
                    <?php for ($i = 1; $i <= $nombreDePage; $i++) : ?>
                        <a href="index.php?controleur=article&action=liste&idCategorie=<?= $laCategorie["id"] ?>&start=<?= ($i * $decalage) - $decalage ?>" class="m-3 fs-3 text-decoration-none text-dark <?= (($i * $decalage) - $decalage == $start) ? "bg-warning rounded-circle" : "bg-light rounded" ?>"><?= $i ?></a>
                    <?php endfor; ?>
                </div>
            </div>
            <div>
                <?php if (!empty(count($lesProduitsTronquesSuivants))) : ?>
                    <div class="text-center">
                        <a href="index.php?controleur=article&action=liste&idCategorie=<?= $laCategorie["id"] ?>&start=<?= $start + $decalage ?>" class="btn btn-primary">Suivant <i class="fas fa-arrow-right"></i></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>