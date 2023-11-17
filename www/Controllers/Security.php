<?php

namespace App\Controllers;
use App\Core\View;

class Security
{

    public function login(): void
    {

        $myView = new View("Security/login", "front");
    }
    public function logout(): void
    {
        echo "Ma page de déconnexion";
    }
    public function register(): void
    {
        echo "Ma page d'inscription";
    }


}