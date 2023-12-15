<?php

namespace App\Controllers;
use App\Core\View;
use App\Forms\UserInsert;
use App\Forms\UserLogin;
use App\Models\User;

class Security
{

    public function cleanInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

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

        if(!$_SERVER["REQUEST_METHOD"] == "POST")
        {
            $myView = new View("Security/register", "front");
            $myView->assign("configForm", $config);
            $myView->assign("errorsForm", $errors);
        }else{ 
            if(!empty($_POST)){
                if(!empty($_POST["firstname"])){
                    $firstname = $this->cleanInput($_POST["firstname"]);
                    if(strlen($firstname) < 2){
                        $errors[] = "Le prénom doit faire plus de 2 caractères";
                    }
                }else{
                    $errors[] = "Le prénom est obligatoire";
                }

                if(!empty($_POST["lastname"])){
                    $lastname = $this->cleanInput($_POST["lastname"]);
                    if(strlen($lastname) < 2){
                        $errors[] = "Le nom doit faire plus de 2 caractères";
                    }
                }else{
                    $errors[] = "Le nom est obligatoire";
                }

                if(!empty($_POST["email"])){
                    $email = $this->cleanInput($_POST["email"]);
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $errors[] = "Le format de l'email est incorrect";
                    }
                }else{
                    $errors[] = "L'email est obligatoire";
                }

                if(!empty($_POST["pwd"])){
                    $pwd = $this->cleanInput($_POST["pwd"]);
                    if(strlen($pwd) < 8){
                        $errors[] = "Le mot de passe doit faire plus de 8 caractères";
                    }
                    if(!preg_match("/[a-z]/", $pwd)){
                        $errors[] = "Le mot de passe doit contenir au moins une minuscule";
                    }
                    if(!preg_match("/[0-9]/", $pwd)){
                        $errors[] = "Le mot de passe doit contenir au moins un chiffre";
                    }
                }else{
                    $errors[] = "Le mot de passe est obligatoire";
                }

                if(!empty($_POST["pwdConfirm"])){
                    $pwdConfirm = $this->cleanInput($_POST["pwdConfirm"]);
                    if($pwdConfirm !== $pwd){
                        $errors[] = "Le mot de passe de confirmation ne correspond pas";
                    }
                }else{
                    $errors[] = "Le mot de passe de confirmation est obligatoire";
            }

            if(count($errors) > 0){
                $myView = new View("Security/register", "front");
                $myView->assign("configForm", $config);
                $myView->assign("errorsForm", $errors);
            }else
            {
                $user = new User();
                //DB error

                // if($user->getOneBy(['email' => $email]))
                //     {
                //     $errors[] = "L'utilisateur existe déjà pour cette adresse mail";
                //     $myView = new View("Security/register", "front");
                //     $myView->assign("configForm", $config);
                //     $myView->assign("errorsForm", $errors);
                //     exit;
                //     }

                $user->setFirstname($firstname);
                $user->setLastname($lastname);
                $user->setEmail($email);
                $user->setPwd($pwd);
                $user->save();

                $myView = new View("Security/register", "front");
                $myView->assign("configForm", $config);
                $myView->assign("errorsForm", $errors);
                exit;
                }
            }
        }

    }
}