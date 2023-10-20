<?php
/*
 *  On récupérer l'uri exemple /login et on récupère la correspondance
 *  par exemple le controller Security et l'action login
 *  Création de l'instance de Security et on appel la method login()
 *  Si pas de correspondance alors on affichera une page 404
 */
namespace App;
use App\Controllers\Error;


spl_autoload_register("App\myAutoloader");

function myAutoloader(String $class): void
{
    //$class = App\Core\View
    $class = str_replace("App\\","", $class);
    //$class = Core\View
    $class = str_replace("\\","/", $class);
    //$class = Core/View
    if(file_exists($class.".php")){
        include $class.".php";
    }
}





//Comment récupérer et nettoyer l'URI
// Exemple on doit avoir "/", "/login", "/logout", ...
$uri = strtolower($_SERVER["REQUEST_URI"]);
$uri = strtok($uri, "?");
$uri = strlen($uri)>1 ? rtrim($uri, "/"):$uri;

// Récupérer le contenu du fichier routes.yaml
if(!file_exists("routes.yaml")){
    die("Le fichier de routing n'existe pas");
}
$listOfRoutes = yaml_parse_file("routes.yaml");


//Créer une instance du bon controller
//et appeler la bonne action
//en effectuant toutes les vérifications nécessaires

/*
 * [/] => Array
        (
            [controller] => Main
            [action] => home
        )
 *
 */

if( !empty($listOfRoutes[$uri]) ){
    if( !empty($listOfRoutes[$uri]['controller']) ){
        if( !empty($listOfRoutes[$uri]['action']) ){

            $controller = $listOfRoutes[$uri]['controller'];
            $action = $listOfRoutes[$uri]['action'];

            if(file_exists("Controllers/".$controller.".php")){
                include "Controllers/".$controller.".php";
                $controller = "App\\Controllers\\".$controller;
                if(class_exists($controller)){
                    $objectController = new $controller();

                    if(method_exists($objectController, $action)){
                        $objectController->$action();
                    }else {
                        die("L'action n'existe pas dans le controller");
                    }

                }else{
                    die("La classe du controller n'existe pas");
                }

            }else{
                die("Le fichier controller n'existe pas");
            }

        }else{
            die("La route ne contient pas d'action");
        }
    }else{
        die("La route ne contient pas de controller");
    }


}else{
    require "Controllers/Error.php";
    $customError = new Error();
    $customError->page404();
}