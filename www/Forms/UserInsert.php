<?php
namespace App\Forms;
class UserInsert
{

    public function getConfig(): array
    {
        return [
            "config"=> [
                        "method"=>"POST",
                        "action"=>"",
                        "submit"=>"S'inscrire",
                        "class"=>"form",
                        "id"=>"form-register"
                     ],
            "inputs"=>[
                "firstname"=>["type"=>"text", "class"=>"input-form" , "placeholder"=>"Prénom", "minlen"=>2, "required"=>true, "error"=>"Le prénom doit faire plus de 2 caractères"],
                "lastname"=>["type"=>"text", "class"=>"input-form", "placeholder"=>"Nom", "minlen"=>2, "required"=>true, "error"=>"Le nom doit faire plus de 2 caractères"],
                "email"=>["type"=>"email", "class"=>"input-form", "placeholder"=>"Email", "required"=>true, "error"=>"Le format de l'email est incorrect"],
                "pwd"=>["type"=>"password", "class"=>"input-form", "placeholder"=>"Mot de passe", "required"=>true, "error"=>"Votre mot de passe doit faire plus de 8 caractères avec minuscule et chiffre"],
                "pwdConfirm"=>["type"=>"password", "class"=>"input-form", "confirm"=>"pwd" ,"placeholder"=>"Confirmation", "required"=>true, "error"=>"Votre mot de passe de confirmation ne correspond pas"],
            ]
        ];
    }

}