<?php
namespace ProgrammerZamanNow\Belajar\PHP\MVC\Middleware;
use ProgrammerZamanNow\Belajar\PHP\MVC\App\View;
use ProgrammerZamanNow\Belajar\PHP\MVC\Config\Database;
use ProgrammerZamanNow\Belajar\PHP\MVC\Repository\SessionRepository;
use ProgrammerZamanNow\Belajar\PHP\MVC\Repository\UserRepository;
use ProgrammerZamanNow\Belajar\PHP\MVC\Service\SessionService;

class MustLoginMiddleware implements Middleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $sessionrepository = new $sessionrepository(Database::getConnection());
        $userRepository = new $Userrepository(Database::getConnection());
        $this->sessionservice = new sessionService($sessionRepository, $userRepository);
        
    }
    function begore(): void
    {
        $user = $this->sessionService->current();
        if ($user == null) {
            View::redirect('/users/login');
        }
    }
}