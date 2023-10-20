<?php
namespace App\Controllers;
use App\Core\View;

class Main
{
    public function home(): void
    {
       $myView = new View("Main/home", "front");
    }


    public function aboutUs(): void
    {
        $myView = new View("Main/aboutus", "front");
    }
}