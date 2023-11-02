<?php

namespace ProgrammerZamanNow\Belajar\PHP\MVC\Controller;

class UserController
{
    private UserServise $userServise;

    public function __constraction()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
    }


    public function register(){
        View::render('User/register', [
            'title'=> 'Register new user',
        ]);
    }
    
    public function postRegister(){

    }
}