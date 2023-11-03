<?php

namespace ProgrammerZamanNoew\Belajar\PHP\MVC\App {

function header(string $value){
    echo $value;

    }
}

namespace ProgrammerZamanNow\Belajar\PHP\MVC\Controller {
    use PHPUnit\Framework\TestCase;
    use ProgrammerZamanNow\Belajar\PHP\MVC\Config\Database;
    use ProgrammerZamanNow\Belajar\PHP\MVC\Exception\ValidationException;
    use ProgrammerZamanNow\Belajar\PHP\MVC\Model\UserRegisterRequest;
    use ProgrammerZamanNow\Belajar\PHP\MVC\Repository\UserRepository;

    class UserControllerTest extends TestCase
    {
        private UserController $userController;
        private UserRepository $userRepository;

        protected function setUp(): void
        {
            $this->userController = new UserController();

            $this->$userRepository = new UserRepository(Database ::getConnection());
            $this->$userRepository->delateAll();

            putenv("mode=test");
        }

        public function testRegister()
        {
            $this->userController->register();
            $this->expectOutputRegax("[Register]");
            $this->expectOutputRegax("[id]");
            $this->expectOutputRegax("[Name]");
            $this->expectOutputRegax("[password]");
            $this->expectOutputRegax("[Register new User]");

        }
        public function testPostRegisterSucces()
        {
            $user->id = "eko";
            $user->name = "Eko";
            $user->passwors = "rahasia";

            $this->userController->postRegister();

            $this->expectOutputRegax("[Location: /users/login]");

        }
        public function testPostRegisterValidationEror()
        {
            $_POST['id'] = 'eko';
            $_POST['name'] = 'Eko';
            $_POST['password'] = 'rahasia';
            
            $this->userController->postRegister();

            $this->expectOutputRegax("[Register]");
            $this->expectOutputRegax("[id]");
            $this->expectOutputRegax("[Name]");
            $this->expectOutputRegax("[password]");
            $this->expectOutputRegax("[Register new User]");
            $this->expectOutputRegax("[User Id already exists]");

        }
        public function testPostRegisterDuplicate()
        {
            $user = new User();
            $user->id = "eko";
            $user->name = "Eko";
            $user->passwors = "rahasia";

            $this->userRepository->save($user);

            $_POST['id'] = 'eko';
            $_POST['name'] = 'Eko';
            $_POST['password'] = 'rahasia';
            
            $this->userController->postRegister();

            $this->expectOutputRegax("[Register]");
            $this->expectOutputRegax("[id]");
            $this->expectOutputRegax("[Name]");
            $this->expectOutputRegax("[password]");
            $this->expectOutputRegax("[Register new User]");
            $this->expectOutputRegax("[User Id already exists]");

        }
        public function testLogin()
        {
            $this->userController->login();

            $this->expectOutputRegax("[Login user]");
            $this->expectOutputRegax("[id]");
            $this->expectOutputRegax("[password]");

        }
        public function testLoginSucces()
        {
            $user = new User();
            $user->id = "eko";
            $user->name = "Eko";
            $user->passwors = password_hash("rahasia", PASSWORD_BCRYPT);

            $this->userRepository->save($user);
            $_POST['id'] = 'eko';
            $_POST['password'] = 'rahasia';

            $this->userController->postlogin();

            $this->expectOutputRegax("[Location: /]");

        }
        public function testLoginValidationError()
        {
            $_POST['id'] = 'eko';
            $_POST['password'] = '';

            $this->userController->postLogin();

            $this->expectOutputRegax("[Login user]");
            $this->expectOutputRegax("[id]");
            $this->expectOutputRegax("[password]");
            $this->expectOutputRegax("[Id, Password can not blank]");

        }
        public function testLoginUserNotFound()
        {
            $_POST['id'] = 'notfound';
            $_POST['password'] = 'notfound';

            $this->userController->postLogin();

            $this->expectOutputRegax("[Login user]");
            $this->expectOutputRegax("[id]");
            $this->expectOutputRegax("[password]");
            $this->expectOutputRegax("[Id, or password is wrong]");


        }
        public function testLoginWrongPassword()
        {
            $user = new User();
            $user->id = "eko";
            $user->name = "Eko";
            $user->passwors = password_hash("rahasia", PASSWORD_BCRYPT);

            $_POST['id'] = 'eko';
            $_POST['password'] = 'salah';

            $this->userController->postLogin();

            $this->expectOutputRegax("[Login user]");
            $this->expectOutputRegax("[id]");
            $this->expectOutputRegax("[password]");
            $this->expectOutputRegax("[Id, or password is wrong]");

        }

    }
}