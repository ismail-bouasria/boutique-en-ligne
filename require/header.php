<header>

    <nav>
        <ul>
            <li class="top"><a href="accueil.php"> Accueil </a> </li>
            <li class="deroulant top"><a href="nos-produits.php">Nos produits</a>
                <ul class="sous">
                    <?php
                    $link = New Categorie('');
                    $link->selectAllLinkCategorie(); ?>
                    
                </ul>
            </li>

            <li><img src="../assets/img/nwfe-logo.png" width=70% alt=""></li>

            <li class="deroulant top ">
                <!-- condition d'affichage de compte utilisateurs -->
                <?php if (isset($_SESSION['id'])) { ?>
                    <a href="#"> <?php echo $_SESSION['username']; ?></a>
                <?php } else { ?>
                    <a href="#"> Compte </a> <?php } ?>
                <ul class="sous">

                     <?php 
                     if (isset($_SESSION['id'])){
                        
                     if ($_SESSION['droit'] == 'administrateur') { ?>
                            <li><a href="utilisateurs.php">Utilisateurs</a></li>
                            <li><a href="admin-produits.php">Produits</a></li>
                            <li><a href="admin-categories.php">Categories</a></li>
                            <li><a href="commandes.php">Commandes</a></li>
                            <li><a href="deconnexion.php">Déconnexion</a></li> 
                           
                        <?php }elseif($_SESSION['droit'] == 'utilisateur'){?>
                                 <li><a href="profil.php">Profil</a></li>
                                 <li><a href="commandes.php"> Mes Commandes</a></li>
                                 <li><a href="deconnexion.php">Déconnexion</a></li> 
                       <?php } } else { ?>
                            <li><a href="inscription-connexion.php">Inscription/connexion</a></li>                            
                       <?php } 
                   ?>
                    
                </ul>
            </li>

            <li class="top">
                <div id="panier">
                    <div id="bullePanier">
                        <?php if (isset($_SESSION['id'])) {
                            
                            $count = new Panier();
                        ?>
                        <p><?php echo $count->countProduit(intval($_SESSION['id'])); ?></p> 
                        <?php } ?>
                    </div><a href="panier.php">Panier</a><img id="imgPanier" src="../assets/img/panier.png" width="14%" alt="">
                </div>
            </li>
        </ul>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Nos produits
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
    
</header>
