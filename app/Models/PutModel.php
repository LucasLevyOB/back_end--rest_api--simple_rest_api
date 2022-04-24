<?php
namespace Models;

use Models\ConnectionModel;
use Models\MethodsHttpModel;

class PutModel extends MethodsHttpModel
{
    private ConnectionModel $connection;
    private string $query;
    private $prepare;

    public function put(int $receivedId, object $receivedData)
    {
        $this->connection = new ConnectionModel();
        $this->query = "UPDATE sra_products SET pro_name=:pro_name, pro_price=:pro_price WHERE pro_id=:pro_id";
        $this->prepare = $this->connection->connectToDatabase()->prepare($this->query);
        $this->prepare->bindParam(':pro_id', $receivedId, \PDO::PARAM_INT);
        $this->prepare->bindParam(':pro_name', $receivedData->pro_name, \PDO::PARAM_STR);
        $this->prepare->bindParam(':pro_price', $receivedData->pro_price, \PDO::PARAM_STR);
        $this->prepare->execute();
        return $this->prepare->rowCount();
    }
}
