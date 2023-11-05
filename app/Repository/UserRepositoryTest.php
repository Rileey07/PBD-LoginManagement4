<?php

namespace LOGINMANAGEMENT4\PhpLoginManagement;

class UserRepositoryTest extends TestCase

{
    private UserRepository $userRepository;
    private SessionRepository $sessionRepository;

 
    protected function setUp(): void

    {
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->userRepository->deleteAll();

        $this->userRepository = new UserRepository(Database::getConnection());
        $this->sessionRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $user = new User();
        $user->id = "kelompok4";
        $user->name ="kelompok4";
        $user->password = "rahasia";

        $this->userRepository->save($user);

        $result = $this->userRepository->findById($user->id);

        self::assertEquals($user->id, $result->id);
        self::assertEquals($user->name, $result->name);
        self::assertEquals($user->password, $result->password);

    }

    public function testFindByIdNotFound()
    {
        $user = $this->userRepository->findById("notfound");
        self::assertNull($user);
    }

    public function testUpdate()
    {
        $user = new User();
        $user->id = "kelompok4";
        $user->name ="kelompok4";
        $user->password = "rahasia";

        $this->userRepository->save($user);
        
        $user->name = "nayla";

        $this->userRepository->update($user);

        $result = $this->userRepository->findById($user->id);

        self::assertNull($user->id, $result->id);
        self::assertNull($user->name, $result->name);
        self::assertNull($user->password, $result->password);
    

    }
}