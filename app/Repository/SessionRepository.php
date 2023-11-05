<?php

namespace ProgrammerZamanNow\Beljar\PHP\MVC\Repository;

use ProgrammerZamanNow\Belajar\PHP\MVC\Domain\Session;

class SessionRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {

    }
    public function save (Session $session): Session 
    {
        $this->connection->prepare("INSERT INTO session(id, user_id) VALUES(?, ?)");
        $statement->execute([$sesssion->id, $session->user_id]);
        return $session;
    }
    public function finfByIId(string $id): ?Session
    {
        $statement=this->connection->prepare("SELECT id, user_id from session WHERE id =?");
        $statement->execute([$id]);

        try{
            if($row = $statement->fect()){
                $session = new Session();
                $session->id = $row['id'];
                $session->userId= $row ['user_id'];
                return $session;

            }else{
                return null;
            }
        } finally {
            $statement->closeCursor();
        }

    }
    public function delateById(string $id) : void
    {
        $this->connection->prepare("DELETE FROM session WHERE id=?");
        $statement->execute([$id]);

    }
    public function delateAll(): void 
    {
        $this->connection->exec("DELATE FROM session");

    }

}