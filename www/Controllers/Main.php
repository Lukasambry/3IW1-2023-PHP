<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\User;
class Main
{
    public function home(): void
    {

        $myUser = new User();
        $myUser->setFirstname("YVEs");
        $myUser->setLastname("Skrzypczyk   ");
        $myUser->setEmail("Y.skrzypczyk@gmail.com");
        $myUser->setPwd("Test1234");


        $myUser->save();

        /*
        $myPage = new Page();
        $myPage->setTitle("MA super page");
        $myPage->setDesc("Description de ma super page");
        $myPage->save();
        */

        $myView = new View("Main/home", "back");
    }

    public function aboutUs(): void
    {
        $myView = new View("Main/aboutus", "front");
    }
}