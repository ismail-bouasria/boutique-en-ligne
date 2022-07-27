<header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-white">
  <a class="navbar-brand" href="accueil.php"><img src="../assets/img/nwfe-logo.png" width="120" height="120" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class=" nav-item ">
        <a class=" nav-item nav-link bg-white " href=" accueil.php ">Accueil </a>
      </li>
      <li class="  nav-item dropdown">
        <a class="  nav-link dropdown-toggle" href="nos-produits.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Nos produits
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php
                    $link = New Categorie('');
                    $link->selectAllLinkCategorie(); ?>
        </div>
      </li>
      <li class=" nav-item dropdown">
        <!-- condition d'affichage de compte utilisateurs -->
        <?php if (isset($_SESSION['id'])) { ?>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $_SESSION['username']; ?>
        </a>
                <?php } else { ?>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mon Compte
        </a> <?php } ?>
               
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

          <?php 
                     if (isset($_SESSION['id'])){
                        
                     if ($_SESSION['droit'] == 'administrateur') { ?>
                            <a class="dropdown-item" href="utilisateurs.php">Utilisateurs</a>
                            <a class="dropdown-item" href="admin-produits.php">Produits</a>
                            <a class="dropdown-item" href="admin-categories.php">Categories</a>
                            <a class="dropdown-item" href="commandes.php">Commandes</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="deconnexion.php">Déconnexion</a>
                           
                        <?php }elseif($_SESSION['droit'] == 'utilisateur'){?>
                                 <a class="dropdown-item" href="profil.php">Profil</a>
                                 <a class="dropdown-item" href="commandes.php"> Mes Commandes</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="deconnexion.php">Déconnexion</a>
                       <?php } } else { ?>
                            <a class="dropdown-item" href="inscription-connexion.php">Inscription/Connexion</a>                           
                       <?php } ?>
        </div>
      </li>
      <li class=" nav-item">
        <div id="panier">
        <a  class="nav-link"href="panier.php">Panier</a>
                        <?php if (isset($_SESSION['id'])) {
                            
                            $count = new Panier();
                        ?>
                         <div >
                        <p id="bullePanier"><?php echo $count->countProduit(intval($_SESSION['id'])); ?></p> 
                        <?php } ?>
                        </div>
                    
                </div>
      </li>
    </ul>
    <div id="searchContainer">
      <form id="formsearch" method="POST" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-3" id="search" type="search" placeholder="Votre produit" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> <span id="chercher">Chercher</span></button>
      </form>

    </div>
  </div>
</nav>
    
</header>
