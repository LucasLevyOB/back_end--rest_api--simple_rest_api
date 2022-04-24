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
    private $result;

    public function get(int $receivedId = null)
    {
        if ($receivedId != null) {
            $this->connection =  new ConnectionModel();
            $this->query = "SELECT * FROM sra_products WHERE pro_id = :pro_id";
            $this->prepare = $this->connection->connectToDatabase()->prepare($this->query);
            $this->prepare->bindParam(':pro_id', $receivedId, PDO::PARAM_INT);
            $this->prepare->execute();
            return $this->prepare->fetch(PDO::FETCH_ASSOC);
        }
        $this->connection =  new ConnectionModel();
        $this->query = "SELECT * FROM sra_products";
        return $this->connection->connectToDatabase()->query($this->query)->fetchAll(PDO::FETCH_ASSOC);
    }
}