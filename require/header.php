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

                     <?php if ($_SESSION['droit'] == 'administrateur') { ?>
                            <li><a href="utilisateurs.php">Utilisateurs</a></li>
                            <li><a href="admin-produits.php">Produits</a></li>
                            <li><a href="admin-categories.php">Categories</a></li>
                            <li><a href="commandes.php">Commandes</a></li>
                           
                        <?php }elseif(isset($_SESSION['id'])){?>
                                 <li><a href="profil.php">Profil</a></li>
                                 <li><a href="commandes.php"> Mes Commandes</a></li>
                                 <li><a href="deconnexion.php">Déconnexion</a></li> 
                       <?php }else { ?>
                            <li><a href="inscription-connexion.php">Inscription/connexion</a></li>                            
                       <?php } ?>
                    
                </ul>
            </li>

            <li class="top">
                <div id="panier">
                    <div id="bullePanier">
                        <p>0</p>
                    </div><a href="#">Panier</a><img id="imgPanier" src="../assets/img/panier.png" width="14%" alt="">
                </div>
            </li>
        </ul>
    </nav>
</header>