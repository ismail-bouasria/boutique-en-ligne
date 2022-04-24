<?php

class Bdd
{
    protected $bdd;

    public function __construct()
    {

        //Connexion à la bdd
        $this->bdd = new PDO('mysql:host=localhost; dbname=boutique-en-ligne', 'root', '');
        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
