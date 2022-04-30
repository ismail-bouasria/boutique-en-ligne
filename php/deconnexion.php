<?php
var_dump('test');
session_start();
session_destroy();
header('Location:accueil.php');

?>