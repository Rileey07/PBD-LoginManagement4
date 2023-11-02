<?php

namespace ProgrammerZamanNow\Belajar\PHP\MVC\Service;

use PHPUnit\Framework\TestCase;
use ProgrammerZamanNow\Belajar\PHP\MVC\Config\Database;
use ProgrammerZamanNow\Belajar\PHP\MVC\Exception\ValidationException;
use ProgrammerZamanNow\Belajar\PHP\MVC\Model\UserRegisterRequest;
use ProgrammerZamanNow\Belajar\PHP\MVC\Repository\UserRepository;




class UserServiceTest extends TestCase
{
    private UserService $userService;
    private UserRepository $userRepository;

    protected function setUp():void 
    {
        $connection = Database::getConnection();
        $this->userRepository = UserRepository($connection);
        $this->userService = new UserService($userRepository);

        $this->userRepository->deleteAll();
    }
    public function testRegisterSucces()
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
    public function testRegisterFailed()
    {
        $this->expecException(ValidationExcaption::class);
        $request = new UserRegisterRequest();
        $request->id = "";
        $request->name="";
        $request->password="";

        $this->userService->register($request);

    }
    public function testRegisterDuplicate()
    {
        $user = new User();
        $user ->id = "eko";
        $user ->name ="Eko";
        $user->password ="rahasia";

        $this->userRepository->save($user);

        this->excepException(ValidationException::class);

        $user = new User();
        $user ->id = "eko";
        $user ->name ="Eko";
        $user->password ="rahasia";

        $this->userService->save($request);




    }
        
    }
