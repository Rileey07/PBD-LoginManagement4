<?php

namespace ProgrammerZamanNow\Belajar\PHP\MVC\Repository;

use PHPUnit\Framework\TestCase;

class SessionRepositoryTest extends TestCase
{
    private function setUp():void 
    {
        $this->sessionRepository = new SessionRepository(Database::getConnection());

        $this->sessionRepository->delateAll();
    }
    public function testSaveSucces()
    {
        $session = new Session ();
        $session ->id = uniqid();
        $session->userId= "eko";
        $this ->sessionRepository->save($session);

        $result =$this->sessionRepository->findById($session->id);
        self::assertEquals($session->id, $result->id);
        self::assertEquals($session->userId, $result->userId);
    
    }
    public function testDelateByIdSusses()
    {
        $session = new Session ();
        $session->id = uniqid();
        $session->userId= "eko";

        $this ->sessionRepository->save($session);

        $result =$this->sessionRepository->findById($session->id);
        self::assertEquals($session->id, $result->id);
        self::assertEquals($session->userId, $result->userId);

        $this ->sessionRepository->delateById($session->id);

        $result =$this->sessionRepository->findById($session->id);
        self::assertNull($result);

    }
    public function testFindByIdNotFound()
    {
        $result =$this->sessionRepository->findById('not found');
        self::assertNull($result);

    }
    
}