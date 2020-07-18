<?php
namespace Models;

use PDO;

use Models\ConnectionModel;
use Models\MethodsHttpModel;

class GetModel extends MethodsHttpModel
{
    private ConnectionModel $connection;
    private string $query;
    private $prepare;

    public function get(int $receivedId = null)
    {
        $this->connection =  new ConnectionModel();
        $this->query = "SELECT * FROM sra_products";
        return $this->connection->connectToDatabase()->query($this->query)->fetch(PDO::FETCH_ASSOC);
    }
}