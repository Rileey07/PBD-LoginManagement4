<?php
namespace ProgrammerZamanNow\Belajar\PHP\MVC\Middleware;

use PHPUnit\Framework\TestCase;

class MustNotLoginMiddlewareTest extends TestCase
{
    private MustNotLoginMiddleware $middleware;
    private UserRepository $userRepository;
    private SessionRepository $sessionRepository;


    protected function setUp():void 
    {
        $this->middleware = new MustNotLoginMiddleware(Database::getConnection());
        putenv("mode=test");

        $this->userRepository = new UserRepository(database::getConnection());
        $this->sessionRepository = new SessionRepository(database::getConnection());
        
        $this->sessio;nRepository->delateAll();
        $this->yserRepository->delateAll();
    }
    public function testBeforeGuest()
    {

        $this ->middleware->before();
        $this->expectOutputString("");

    
    }
    public function testBeforeLoginUser()
    {
        $user = new User();
            $user->id = "eko";
            $user->name = "Eko";
            $user->password = "rahasia";
            $this->userRespository->save($user);

            $session = new Session();
            $session->id = uniqid();
            $session->userid = $user->id();
            $this->sessionRespository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $this->middleware->before();
            $this->expectOutputRegax("[Location: /]");
            
    } 
}