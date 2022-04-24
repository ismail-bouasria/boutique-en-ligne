<?php
session_start();
$_SESSION["connected"] = false;
echo "\n Vous êtes maintenant deconnecté";
session_destroy();
header("Location: accueil.php");
