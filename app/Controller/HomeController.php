<?php

namespace LOGINMANAGEMENT4\PhpLoginManagemen;

use ProgrammerZamanNow\Belajar\PHP\MVC\App\View;

class HomeController
{

    private sessionService $sessionService;
    
    public function __construct()
    {
        $connection = Database::getConnection();
        $sessionRepository = new SessionRepository($connection);
        $userRepository = new UserRepository($connection);
        $this->sessionService = new sessionService($SessionRepository, $userRepository);
    }

    function index()
    {
        $user = $this->sessionService->current();
        if ($user == null) {
            View::render('/Home/Index',[
                "title" => "PHP Login Management"
            ]);
        } else {
            View::render('Home/dashbord',[
                "tittle" => "Dashboard",
                "user" => [
                    "nama" => $user->nama
                ]
            ]);

        }

    }
}