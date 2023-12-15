<?php
namespace App\Forms;
class UserLogin
{

    public function getConfig(): array
    {
        return [
            "config"=> [
                        "method"=>"POST",
                        "action"=>"",
                        "submit"=>"Se connecter",
                        "class"=>"form",
                        "id"=>"form-login"
                     ],
            "inputs"=>[
                "email"=>["type"=>"email", "class"=>"input-form", "placeholder"=>"Email", "required"=>true, "error"=>"Le format de l'email est incorrect"],
                "pwd"=>["type"=>"password", "class"=>"input-form", "placeholder"=>"Mot de passe", "required"=>true, "error"=>"Votre mot de passe doit faire plus de 8 caractères avec minuscule et chiffre"],
                ]
        ];
    }

}