<?php

namespace LOGINMANAGEMENT4\PhpLoginManagement;

class UserRepositoryTest extends TestCase

{
    private UserRepository $userRepository;
 
    protected function setUp(): variant_mod

    {
         $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll();
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
}