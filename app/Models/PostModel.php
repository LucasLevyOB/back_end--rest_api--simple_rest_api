<?php
namespace Models;

use Models\ConnectionModel;
use Models\MethodsHttpModel;

class PostModel extends MethodsHttpModel
{
    private ConnectionModel $connection;
    private string $query;
    private $prepare;

    public function post(object $receivedData)
    {
        $this->connection = new ConnectionModel();
        $this->query = "INSERT INTO sra_products(pro_name, pro_price) VALUES(:pro_name, :pro_price)";
        $this->prepare = $this->connection->connectToDatabase()->prepare($this->query);
        $this->prepare->bindParam(':pro_name', $receivedData->pro_name, \PDO::PARAM_STR);
        $this->prepare->bindParam(':pro_price', $receivedData->pro_price, \PDO::PARAM_STR);
        $this->prepare->execute();
        return $this->prepare->rowCount();
    }
}