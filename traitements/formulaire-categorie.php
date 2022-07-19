
<?php
session_start();
require '../classes/Bdd.php';
require '../classes/Categorie.php';
$_SESSION['erreur'] = '';
  

// Ajouter une categorie :

if (isset($_POST['subcat'])) {
    $nom = htmlspecialchars($_POST['name']);

    if (!empty($nom)) {
        // Vérifie si le fichier a été uploadé sans erreur.
        if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
     
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $_FILES["photo"]["name"] = uniqid().'.jpg';
            $filename = $_FILES["photo"]["name"];
            $filetype = $_FILES["photo"]["type"];
            $filesize = $_FILES["photo"]["size"];
            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die(header('Location: ../php/admin-categories.php?err=errorfilename'));

                // Vérifie la taille du fichier - 5Mo maximum
                $maxsize = 5 * 1024 * 1024;
                if($filesize > $maxsize) die(header('Location: ../php/admin-categories.php?err=errorfilesize'));

                    // Vérifie le type MIME du fichier
                    if(in_array($filetype, $allowed)){
                    // Vérifie si le fichier existe avant de le télécharger.
                        
                    $path ='../assets/upload/'.$filename;
                    $categorie = new Categorie ('');
                    if (empty($categorie->getNameCategorie($nom))) {
                        
                        $categorie->addCategorie($nom,$path);
                        $_SESSION['avatar'] = $path;
                        move_uploaded_file($_FILES["photo"]["tmp_name"], "../assets/upload/" . $_FILES["photo"]["name"]);
                        header('location:../php/admin-categories.php?succed=addcategory');
                        $_SESSION['reussi'] = '<h1> Ajout de catégorie réussi !</h1> <p> Nouvelle catégorie ajoutée. </p>';
                    
                    }else {
                        header('Location: ../php/admin-categories.php?err=samecategory');
                        $_SESSION['erreur'] = '<h1> Ajout de catégorie Impossible !</h1> <p> La catégorie existe déjà. </p>';
                    }
                    
                } 
            } else{
                header('Location: ../php/admin-categories.php?err=errornofile');
                $_SESSION['erreur'] = '<h1> Ajout de catégorie Impossible !</h1> <p> Aucune image téléchargée. </p>';
        }
    }else {
        header('Location: ../php/admin-categories.php?err=noinfos');
        $_SESSION['erreur'] = '<h1> Ajout de catégorie Impossible !</h1> <p> Remplir les champs. </p>';
    }



    
}

//  Modifier une categorie

if (isset($_POST['modcat'])) {
    $nom = htmlspecialchars($_POST['name']);
    $idCategorie = $_SESSION['get'];

    if (!empty($nom)) {
        // Vérifie si le fichier a été uploadé sans erreur.
        if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
     
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $_FILES["photo"]["name"] = uniqid().'.jpg';
            $filename = $_FILES["photo"]["name"];
            $filetype = $_FILES["photo"]["type"];
            $filesize = $_FILES["photo"]["size"];

            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die(header('Location: ../php/admin-modification.php?err=errorfilename'));

                // Vérifie la taille du fichier - 5Mo maximum
                $maxsize = 5 * 1024 * 1024;
                if($filesize > $maxsize) die(header('Location: ../php/admin-modification.php?err=errorfilesize'));

                    // Vérifie le type MIME du fichier
                    if(in_array($filetype, $allowed)){
                    // Vérifie si le fichier existe avant de le télécharger.
                        
                    $path ='../assets/upload/'.$filename;
                    $categorie = new Categorie ('');
                    $nameCategorie = $categorie->getNameCategorie($nom);

                    if (empty($namecategorie) || $nom == $nameCategorie ) {
                        
                        $categorie->updateCategorie($nom,$path,$idCategorie);
                        $_SESSION['avatar'] = $path;
                        move_uploaded_file($_FILES["photo"]["tmp_name"], "../assets/upload/" . $_FILES["photo"]["name"]);
                        header('location:../php/admin-categories.php?succed=category');
                        $_SESSION['reussi'] = '<h1> Modification de la catégorie réussi !</h1>';
                    
                    }else {
                        header('Location: ../php/admin-modification.php?err=samecategory');
                        $_SESSION['erreur'] = '<h1> Modification de la catégorie Impossible !</h1> <p> La catégorie existe déjà. </p>';
                    }
                    
                } 
            } else{
                header('Location: ../php/admin-modification.php?err=errornofile');
                $_SESSION['erreur'] = '<h1> Modification de la catégorie Impossible !</h1> <p> Aucune image téléchargée. </p>';
        }
    }else {
        header('Location: ../php/admin-modification.php?err=noinfos');
        $_SESSION['erreur'] = '<h1> Modification de la catégorie Impossible !</h1> <p> Remplir les champs. </p>';
    }
}
?>