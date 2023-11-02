<?php

namespace ProgrammerZamanNow\Belajar\PHP\MVC\Service;

use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp():void 
    {
        $connection = Database::getConnection();
        $userRepository = UserRepository($connection);
        $this->userService = new UserService($userRepository);

        $userRepository->deleteAll();
    }
    public function testRegisterSucces()
    {
        $response = $this->userService->register($request);
    }
    public function testRegisterFailed()
    {
        $request = new UserRegisterRequest();
        $request->id = "eko";
        $request->name="Eko";
        $request->password="rahasia";

        $response= $this->userService->register($request);

        self::assertEquals(request->id, $response->user->id);
        self::assertEquals(request->name, $response->user->name);
        self::assertNotEquals(request->password, $response->user->password);

        self::assertTrue(password_varify($request->password, $response->user->id));
    }
    public function testRegisterDuplicate()
    {

    }
        
    }
