<?php

namespace ProgrammerZamanNow\Belajar\PHP\MVC\Controller;

class UserController
{
    private UserService $userService;
    private SessionService $SessionService;

    public function __constraction()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);

        $sessionRepository = new sessionRepository($connection);
        $this->sessionservice = new SessionService($sessionRepository, $userRepository);

    }


    public function register(){
        View::render('User/register', [
            'title'=> 'Register new user',
        ]);
    }
    
    public function postRegister(){
        $request = new UserRegisterRequest();
        $request->id = $_POST['id'];
        $request->name = $_POST['name'];
        $request->password = $_POST['password'];

        try {
            $this->userService->register($request);
            // redirect to /user/login
            View::redirect('/users/login');
        }catch (ValidationException $Exception){
            View::render('User/register', [
                'title'=> 'Register new User',
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function login()
    {
        View::render('User/login', [
            'title'=> 'Login user'
        ]);
    }
    public function postLogin()
    {
        $request = new UserLogRequest();
        $request->id =$_POST['id'];
        $request->password = $_POST ['password'];

        try {
            $response = $this->userService->login($request);
            $this->sessionService->create($response->user->id);
            View::redirect('/');

        }catch (ValidationException $exception){
            View::render('User/login', [
                'title'=> 'Login user',
                'error' => $exception->getMessage()
            ]);

        }

    }
    public function logout(){
        $this->sessionService->destroy();
        view::redirect("/");

    }
}
