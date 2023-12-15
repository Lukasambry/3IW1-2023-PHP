<?php

namespace App\Controllers;
use App\Core\View;
use App\Forms\UserInsert;
use App\Forms\UserLogin;

class Security
{

    public function login(): void
    {

        $formLogin = new UserLogin();
        $configLogin = $formLogin->getConfig();

        $formRegister = new UserInsert();
        $configRegister = $formRegister->getConfig();

        $myView = new View("Security/login", "front");
        $myView->assign("configFormLogin", $configLogin);
        $myView->assign("configFormRegister", $configRegister);
    }
    public function logout(): void
    {
        echo "Ma page de déconnexion";
    }
    public function register(): void
    {
        $form = new UserInsert();
        $config = $form->getConfig();

        $errors = [];

        //Est ce que le formulaire a été soumis
        //Ensuite est-ce que les données sont OK
        //-> si oui insertion en bdd
        //-> sinon on va envoyer les erreurs à la vue

        $myView = new View("Security/register", "front");
        $myView->assign("configForm", $config);
        $myView->assign("errorsForm", $errors);

    }


}