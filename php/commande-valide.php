<?php
session_start();
require '../classes/Bdd.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
require '../classes/Commandes.php';
require '../classes/Historiques-panier.php';


$commande = new Commandes();
$historique = new HistoriquePanier();
$idUser= intval($_SESSION['id']); 
$idCommande = intval($_SESSION['idCommande']);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>commande Validé</title>
    <link rel="stylesheet" href="../assets/css/boutique.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/cssboot/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/53bdaa6800.js" crossorigin="anonymous"></script>
</head>

<body class="w-full h-full">
    <?php
    require '../require/header.php';
    ?>
    <main>
       
     <?php if (isset($_SESSION['id'])) {
      
        $infos = $commande->getCommande($idUser,$idCommande);
        ?>
        
       <div class="contenairBdc">
        <section class="bonCommande">
            <img src="../assets/img/nwfe-logo.png" width="20%" alt="No westing for food">
          <h1> Commande Validé ! </h1>

          
          <p> <span class="green"> Numero de la commande </span> : <?php echo $infos[0]['numero'] ?> </p>
          <p> <span class="green"> Date</span> : <?php echo $infos[0]['date'] ?> </p>
          <?php 
       
          $livraison = $infos[0]['id_adresse'];
           if ($livraison == 1) {?>
           <p> COMMANDE À EMPORTER </p>
          <?php }elseif ($livraison == 2) {?>
            <p> COMMANDE SUR PLACE </p>
          <?php }else { ?>
            <p> COMMANDE EN LIVRAISON </p>
          <?php } ?>
        
          
          <table class="tablecommande">
                    <thead>
                        <tr>
                            <th>
                                <h5>Produit</h5>
                            </th>
                            <th>
                                <h5>Quantité</h5>
                            </th>

                            <th>
                                <h5>Prix</h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($infos as $value ) : ?>
                            <tr>

                                <td><?= $value["nom"]; ?></td>
                                <td><?= $value["quantite"]?></td>
                                <td><?= $value["prix"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
         
        </table>

        <h5 id="texth"> Prix total : <?php  echo $historique->sumPrix($idCommande); ?> €</h5>
        <h5 id="texth2"> Total produit : <?php  echo $historique->totalPrix($idCommande); ?> </h5>

        <p id="texth3">* Vous pouvez retrouvez un récapitutalif de vos commandes dans votre zone membre.*</p>

        </section>
    </div>
       <?php } ?>

    </main>
    <?php
    require '../require/footer.php';
    ?>
</body>

</html>