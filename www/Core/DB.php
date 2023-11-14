<?php
namespace App\Core;

class DB
{
    public function __construct()
    {
        //Début pour récupérer le nom de la table en bdd
        echo get_called_class();
    }


    public function save()
    {
        echo "Enregistrement en BDD";
    }

}