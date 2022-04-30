<?php

session_start();

require("../classes/Produit.php");
$produit = new Produit();





if (isset($_POST["submit"])) {

    $categorie = htmlspecialchars($_POST['category']);
    $nom = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $prix = htmlspecialchars($_POST['price']);
    $prix = floatval($prix);
    $stock = htmlspecialchars($_POST['stock']);
              
    if (!empty($nom) && !empty($categorie) && !empty($description) && !empty($prix) && !empty($stock)) {
        // Vérifie si le fichier a été uploadé sans erreur.
        if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
     
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $_FILES["photo"]["name"] = uniqid().'.jpg';
            $filename = $_FILES["photo"]["name"];
            $filetype = $_FILES["photo"]["type"];
            $filesize = $_FILES["photo"]["size"];
            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die(header('Location: ../php/admin-produits.php?err=errorfilename'));

                // Vérifie la taille du fichier - 5Mo maximum
                $maxsize = 5 * 1024 * 1024;
                if($filesize > $maxsize) die(header('Location: ../php/admin-produits.php?err=errorfilesize'));

                    // Vérifie le type MIME du fichier
                    if(in_array($filetype, $allowed)){
                    // Vérifie si le fichier existe avant de le télécharger.
                        
                    $path ='../assets/upload/'.$filename;
                    $produit = new Produit();
                    if (empty($produit->getNameProduct($nom))) {
                        
                        $produit->addProduct($path,$nom,$description,$prix, $stock, $categorie);
                        $_SESSION['avatar'] = $path;
                        move_uploaded_file($_FILES["photo"]["tmp_name"], "../assets/upload/" . $_FILES["photo"]["name"]);
                        header('location:../php/admin-produits.php?succed=addcategory');
                        $_SESSION['reussi'] = '<h1> Ajout de produit réussi !</h1> <p> Nouveau produit ajouté. </p>';
                    
                    }else {
                        header('Location: ../php/admin-produits.php?err=samecategory');
                        $_SESSION['erreur'] = '<h1> Ajout de produit Impossible !</h1> <p> Le produit existe déjà. </p>';
                    }
                    
                } 
            } else{
                header('Location: ../php/admin-produits.php?err=errornofile');
                $_SESSION['erreur'] = '<h1> Ajout de produit Impossible !</h1> <p> Aucune image téléchargée. </p>';
        }
    }else {
        // header('Location: ../php/admin-produits.php?err=noinfos');
        $_SESSION['erreur'] = '<h1> Ajout de produit Impossible !</h1> <p> Remplir les champs. </p>';
        var_dump($nom);
        var_dump($description);
        var_dump($categorie);
        var_dump($prix);
        var_dump($stock);
    }
}
    




   





?>