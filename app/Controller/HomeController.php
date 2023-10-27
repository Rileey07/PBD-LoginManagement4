<?php

namespace LOGINMANAGEMENT4\PhpLoginManagemen;

use ProgrammerZamanNow\Belajar\PHP\MVC\App\View;

class HomeController
{

    function index(){
        View::render('/Home/Index',[
        "title" => "PHP Login Management"
    ]);

    }
}

