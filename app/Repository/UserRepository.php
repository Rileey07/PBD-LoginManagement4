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

    //vidio 31
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
}