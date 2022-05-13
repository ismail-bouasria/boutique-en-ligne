<?php

class Bdd 
{
    protected $bdd;

    public function __construct()
    {
        //on donne des variables aux valeurs de connexion 
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        
        //On établit la connexion
        $this->bdd = new PDO("mysql:host=$servername;
        dbname=boutique-en-ligne", $username, $password);
    }
 


}
