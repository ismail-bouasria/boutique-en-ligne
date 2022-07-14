<?php
session_start();
require '../classes/Bdd.php';
require '../classes/Categorie.php';
require '../classes/Panier.php';
$categorie = new Categorie('');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Nos produits</title>
    <link rel="stylesheet" href="../assets/css/boutique.css">
    <link rel="stylesheet" href="../assets/css/nos-produit.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/cssboot/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>

</head>

<body>
    <?php
    require '../require/header.php';
    ?>
    <main>
        <section>
            <h1> Notre carte </h1>
        </section>
        <div id="contenair">
            <?php
            foreach ($categorie->getAllCategorie() as $value) { ?>

                <div class="typeProduit">
                    <section>

                        <a href="categorie-produit.php?categorie=<?php echo $value['id']; ?>">
                            <h2> <?php echo $value['nom']; ?> </h2>
                        </a>
                    </section>
                    <a href="<?php echo $value['id']; ?>"> <img src="<?php echo $value['image']; ?>" alt="<?php echo $value['nom']; ?>"></a>
                </div>
            <?php } ?>



        </div>

    </main>
    <?php
    require '../require/footer.php';
    ?>
</body>

</html>