<?php

namespace ProgrammerZamanNow\Belajar\PHP\MVC\Service;

use ProgrammerZamanNow\Belajar\PHP\MVC\Model\UserRegisterRequest;
use ProgrammerZamanNow\Belajar\PHP\MVC\Model\UserRegisterResponse;
use ProgrammerZamanNow\Belajar\PHP\MVC\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->UserRepository = $userRepository;
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse
   {
        $this->validateUserRegistrationRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userRepository->findById($request->id);
            if($user != null){
                throw new ValidationException("User id already exists");
            }

            $user = new User();
            $user->id = $request->id;
            $user->name = $request->name;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);

            $this->userRepository->save($user);

            $response = new userRegisterResponse();
            $response->user = $user;
            return $response;
            
            Database::commitTransaction();
        }catch (\Exception $exception){
            Database::rollbackTransaction();
            throw $exception;
        }
    }

   private function validateUserRegistrationRequest(UserRegisterRequest $request) {
        if($request ->id == null || $request->name == null || $request->passwoard == null ||
        trim ($request->id)== "" || trim($request->name)==""|| trim($request->passwoard)==""){
        throw new ValidationException ("id, Name,Passwoard can not blank");
        }
   }
}