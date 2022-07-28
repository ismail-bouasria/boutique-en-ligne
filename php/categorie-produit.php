<?php
session_start();

require '../classes/Produit.php';
require '../classes/Souscategorie.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';



$produit = new Produit('');
$categorie = new SousCategorie('');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/boutique.css">
    <link rel="stylesheet" href="../assets/css/categorie-produit.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/cssboot/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/search.js"></script>
    <title>Categorie Produit</title>

</head>


<body>
    <?php
    require '../require/header.php';

    if (!empty($_GET)) { ?>
        <main>
            <section>
                <h1>Sandwichs</h1>
            </section>
            <?php

            $categorieId = intval(strip_tags($_GET['categorie']));
            // On détermine sur quelle page on se trouve
            if (isset($_GET['start']) && !empty($_GET['start'])) {

                @$pageActuelle = (int) strip_tags($_GET['start']);
            } else {
                $pageActuelle = 1;
            }

            // On détermine le nombre de sous-categorie par page
            $parcategorie = 3;

            // On calcule le nombre de page total arrondie au supérieur

            $pages = ceil($categorie->nb_SousCategories($categorieId) / $parcategorie);

            // Calcul de la sous categorie de la page
            $premier = ($pageActuelle * $parcategorie) - $parcategorie;


            foreach ($categorie->getAllSousCategorie($categorieId, $premier, $parcategorie) as $value) { ?>

                <div id="categorie">
                    <section>
                        <h2><b><?php echo $value['nom'] ?></b></h2>
                    </section>
                    <?php
                    $getProduit = $produit->getAllProductsByID($value['id']);
                    if (!empty($getProduit)) {
                        foreach ($getProduit as $valueP) { ?>

                            <div id="cat-produits">
                                <div class="img-container">
                                    <img src="<?php echo $valueP['image']; ?>" alt="<?php echo $valueP['nom']; ?>" />
                                    <div class="img-content">
                                        <h1> <?php echo $valueP['nom']; ?></h1>
                                        <p> <?php echo $valueP['description']; ?></p>
                                        <h1> Prix : <span> <?php echo $valueP['prix']; ?>€</span> </h1>
                                        <a href="page-produit.php?produit=<?php echo $valueP['id']; ?>" class=" btn-primary2" target="blank"> Commander !</a>
                                    </div>
                                </div>
                            </div>
                        <?php  } ?>
                    <?php  } else { ?>
                        <section id="no-produits">
                            <h3>Pas de produit pour le moment</h3>
                        </section>;
                    <?php } ?>
                </div>

            <?php  } ?>


            <!-----------------------------------------BOX PAGINATION-------------------------------------------->
            <div class="boxpagination">

                <nav id=" navPagination">
                    <ul>
                        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->

                        <li class="<?= ($pageActuelle == 1) ? "disabled" : "" ?>">
                            <?php if (isset($_GET['categorie'])) { ?>
                                <a href="categorie-produit.php?categorie=<?= $categorieId ?>&start=<?= $pageActuelle - 1 ?>">Précédente</a>
                            <?php } else { ?>
                                <a href="categorie-produit.php?categorie=<?= $categorieId ?>?start=<?= $pageActuelle - 1 ?>">Précédente</a>
                            <?php } ?>
                        </li>

                        <?php for ($page = 1; $page <= $pages; $page++) : ?>
                            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                            <li class=" page-link">
                                <?php if (isset($_GET['categorie'])) { ?>
                                    <a class=" <?= ($pageActuelle == $page) ? "active" : "" ?>" href="categorie-produit.php?categorie=<?= $categorieId ?>&start=<?= $page ?>"><?= $page ?></a>
                                <?php } else { ?>
                                    <a href="categorie-produit.php?categorie=<?= $categorieId ?>?start=<?= $page ?>"><?= $page ?></a>
                                <?php } ?>
                            </li>
                        <?php endfor ?>
                        <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                        <li class="<?= ($pageActuelle == $pages) ? "disabled" : "" ?>">
                            <?php if (isset($_GET['categorie'])) { ?>
                                <a href="categorie-produit.php?categorie=<?= $categorieId ?>&start=<?= $pageActuelle + 1 ?>">Suivante</a>
                            <?php } else { ?>
                                <a href="categorie-produit.php?categorie=<?= $categorieId ?>?start=<?= $pageActuelle + 1 ?>">Suivante</a>
                            <?php } ?>

                        </li>
                    </ul>
                </nav>
            </div>


            <form>
                <input type="button" value="retour" onclick="history.go(-1)">
            </form>
        </main>
    <?php } else {
        header('location:nos-produits.php');
    } ?>


    <?php
    require '../require/footer.php';
    ?>
</body>

</html>