<?php
session_start();
require '../classes/Produit.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
require '../classes/Historiques-panier.php';
require '../classes/Commandes.php';

$produit = new Produit();
$panier = new Panier('');
$commande = new Commandes();
$historique = new HistoriquePanier();

if (isset($_GET['supprimer'])) {
    $idUser = $_SESSION['id'];
    $idProduit =  strip_tags(intval($_GET['supprimer']));
    $numero = $commande->getNumero($idUser);
    
 $panier->deleteProduitPanier($idUser,$idProduit);
 $historique->deleteProduitHistorique($numero,$idProduit);
 }

 if (isset($_GET['modifier'])) {
    $idUser = $_SESSION['id'];
    $idProduit =  strip_tags(intval($_GET['modifier']));
    $numero = $commande->getNumero($idUser);
    $quantite = intval($_POST["quantite"]);
   
    
 $panier->updatePanier($quantite, $idProduit, $idUser);
 $historique->updateHistorique($quantite,$idProduit,$numero);
 }

?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/boutique.css">
    <link rel="stylesheet" href="../assets/css/panier.css">
    <link rel="stylesheet" href="../assets/css/page-produit.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/cssboot/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <title>Panier</title>

</head>


<body>
    <?php
    require '../require/header.php';
    ?>



    <main>
        <div id="panier-container">
            <div id="panier-produit">
                <?php 
                  $contenuPanier = $panier->showProduitPanier($_SESSION['id']);
                 if (!empty($contenuPanier)) {
                
          
                 foreach ($contenuPanier as $value) { 

                    
                ?>
                 
                <div id="add-produit">
                    <section class="prix">
                        <h3><b>Total = <?php echo $total = $value['prix'] * $value['quantite']; ?> € TTC</b></h3>
                    </section>
                    <div id="infos">
                        <section >
                            <img  id="image" src="<?php echo $value['image'];?>" alt="">
                        </section>
                        <div id="information">
                            <h2><?php echo $value['nom'];?></h2>
                            <p> Description : <?php echo $value['description']; ?> </p>
                            <p> Prix : <?php echo $value['prix']; ?> € </p>
                            <div>
                                <form action="panier.php?modifier=<?= $value["id"] ?>" method="post">
                                <p>Quantité :</p>
                                <input type="number"  class="number quantite" name="quantite" required="required" min="1" value="<?php echo $value['quantite'];?>" max="<?php echo $value['stock']; ?>" colisage="1">
                                <button type="submit"  class="plus1">Modifier </button>
                                 </form>
                            </div>
                        </div>

                    </div>
                    <section id="supprimer">
                    
                        <button class="moins1"><a class="text-decoration-none" href="panier.php?supprimer=<?= $value["id"] ?>">Supprimer </a></button>
                    </section>
                    
                </div>
                <?php 
                }
                 }else { ?>
                    <div id="add-produit">
                        <h2>Le Panier est vide</h2>
                    </div>
                 <?php } ?>

            </div>

            <div id="total-infos">
                <div id="total-produit">
                    <section>  <h2>  Total produit : <?php echo $count->sumProduit(intval($_SESSION['id'])); ?> </h2>  </section>

                    <section> <h2> Total TTC : <?php  echo $panier->sumPrix($_SESSION['id']);?>€</h2></section>

                      
                   <a href="livraisons.php"><button type="submit" name="Commander"> Passer commande </button></a>
                   
                </div>

                

            </div>

        </div>





        <div id="categorie">
            <section>
                <h2><b>Selection inspirée par nos clients  </b></h2>
            </section>
            <div id="flexcat">
                <?php
                $getProduit = $produit->getAllProducts();

                foreach ($getProduit as $valueP) { ?>
                    <div id="cat-produits">

                        <div class="img-container">
                            <img src="<?php echo $valueP['image']; ?>" alt="<?php echo $valueP['nom']; ?>" />
                            <div class="img-content">
                                <h1> <?php echo $valueP['nom']; ?></h1>
                                <p> <?php echo $valueP['description']; ?></p>
                                <h1> Prix : <span> <?php echo $valueP['prix']; ?>€</span> </h1>
                                <a href="page-produit.php?produit= <?php echo $valueP['id']; ?>" class="btn btn-primary" target="blank"> Commander !</a>
                            </div>
                        </div>

                    </div>
                <?php  } ?>
            </div>
        </div>


    </main>

    <?php
    require '../require/footer.php';
    ?>
</body>

</html>


   