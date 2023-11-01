<?php

namespace LOGINMANAGEMENT4\PhpLoginManagement;

class UserRepository

{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }
    public function save(User $user): User {
        $statement = $this->connection->prepare("INSERT INTO users(id, name, password) VALUES (?, ?,?)");
        $statement->execute([
            $use->id, $user->name, $user->password
        ]);
        return $user;
    }

    //step31
    public function update(User $user): User {
        $statement = $this->connection->prepare("UPDATE users SET name = ?, password = ? WHERE id = ?");
        $statement->execute([
            $user->name, $user->password, $user->id
            ]);
            return $user;
    }

    public function findById(string $id): User {
        $statement = $this->connection->prepare("SELECT users(id, name, password) VALUES (?, ?,?)");
        $statement->execute([$ID]);

    try {
        if($row = $statement->fetch()){
            $user = new User();
            $user->id = $row['id'];
            $user->name = $row['name'];
            $user->password = $row['password'];
            return $user;

        }else{
            return null;
        }
    }finally {
        $statement->closeCursor();
    }
    }

    //step32
    public function testUpdate()
    {
        $user = new User();
        $user->id = "eko";
        $user->name = "Eko";
        $user->password = "rahasia";

        $this->userRepository->save($user);

        $user->name = "Budi";
        $this->userRepository->update($user);

        $result = $this->userRepository->findById($user->id);
        
        self::assertEquals($user->id, $result->id);
        self::assertEquals($user->name, $result->name);
        self::assertEquals($user->password, $result->password);
    }
}