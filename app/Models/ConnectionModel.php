<?php
namespace Models;

use PDO;

class ConnectionModel
{
    private \PDO $connection;

    public function connectToDatabase()
    {
        try {
            $dsn = 'mysql:dbname='. DATABASENAME. ';host='. HOSTNAME;
            $this->connection = new \PDO($dsn, USERNAME, PASSWORD);
            return $this->connection;
        } catch (\PDOException $error) {
            return "Error code: {$error->getCode()}<br>Error: {$error->getMessage()}";
        }
    }
}