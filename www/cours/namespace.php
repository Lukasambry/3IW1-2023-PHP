<?php
namespace App\Controllers;
class User{

}


/*    -------------------------------------------  */

namespace App\Models;
class User{

}


/*    -------------------------------------------  */

namespace App;
use App\Models\User as UserModel;
use App\Controllers\User as UserController;

//chemin absolue
//new \App\Models\User();
//chemin relatif
//new Models\User();

new UserModel();
new UserController();