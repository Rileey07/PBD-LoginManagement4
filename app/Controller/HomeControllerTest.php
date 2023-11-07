<?php
namespace video25;

class HomeControllerTest extends TestCase
{
   private HomeController $homeController;
   private userRepository $userRepository;
   private SessionRepository $sessionRepository;

   protected function setUp():void
   {
    $this->homeController = new HomeController();
    $this->sessionRepository = new SessionRepository(Database::getConnection());
    $this->sessionRepository = new UserRepository(Database::getConnection());

    $this->sessionRepository->deleteAll();
    $this->userRepository->deleteAll();

   } 

    public function testGuest()
    {
        $this->homeController->index();
     
        $this->expectOutputRegex("[Login Management]");
    }
    public function testUserLogin()
    {
        $user = new User();
        $user->id = "eko";
        $user->name = "Eko";
        $user->password = "rahasia";
        $this->userRepository->save($session);

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $this->homeController->index();

        $this->expectOutputRegex("[Hello Eko]");
    }
    
}