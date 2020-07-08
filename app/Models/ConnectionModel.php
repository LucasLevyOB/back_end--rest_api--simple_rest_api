<?php
namespace Models;

use PDO;

abstract class ConnectionModel
{
    private \PDO $connection;

    protected function connectToDatabase()
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