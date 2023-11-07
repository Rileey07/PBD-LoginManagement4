<?php

namespace video24 {
    function header(string $value){
        echo  $value;  
}
}
namespace video24 {
    function setcookie(string $name, string $value){
        echo "$name: $value";  
}

}

class SessionService  extends TestCase

{
    private SessionService $sessionService;
    private SessionRepository $sessionRepository;
    private UserRepository $UserRepository;
    
    protected function setUp():void
    {
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->UserRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($this->sessionRepository, $this->userRepository);
        
        $this->sessionRepository->deleteAll(); 
        $this->userRepository->deleteAll();  

        $user = new User();
        $user->id = "eko";
        $user->name = "Eko";
        $user->password = "rahasia";
        $this->userRepository->save ($user);
        
    }
    

    public function testCreate()
    {
        $user = new User();
        $user->
        $session = $this->sessionService->create("eko");

        $this->expectOutputRegex("[X-P2N-SESSION: $session->id");
        
        $result = $this->sessionRepository->findByid($session->id);

        self::assertEquals("eko", $result-> userId);
    }
    public function TestDestroy()
    {
        $session = new Session();
        $session->id = new uniqid();
        $session->userId = "eko";

        $this->sessionRepository->save($session);

        $_COOKIE[sessionService::$COOKIE_NAME] = $session->id;

        $this->sessionService->destroy();

        $this->expectOutputRegex("[X-P2N-SESSION: ]");

        $result = $this->sessionRepository->findById($session->id);
        self::assertNull($result);
    }
    
    public function textCurrent()
    {
        $session = new Session();
        $session->id = new uniqid();
        $session->userId = "eko";

        $this->sessionRepository->save($session);

        $_COOKIE[sessionService::$COOKIE_NAME] = $session->id;
        
        $user = $this->sessionService->current();

        self::assertEquals($session->userId, $user->id);

    }
}