<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\User;
use App\Models\Article;

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

        $myArticle = new Article();
        $myArticle->setId(1);
        $myArticle->setTitle("Hello Yves");
        //$myArticle->setSlug("fdsfds2");
        $myArticle->setContent("grht");
        $myArticle->save();

        $myUser2 = new User();
        $myUser2->populate(1);
        $myUser2->setFirstname('Pas_YVES');
        $myUser2->setLastname('Pas_Skrypzcyk');
        $myUser2->save();

        $myView = new View("Main/home", "back");
    }

    public function aboutUs(): void
    {
        $myView = new View("Main/aboutus", "front");
    }
}