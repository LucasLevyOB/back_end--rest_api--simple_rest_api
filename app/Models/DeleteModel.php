<?php
namespace Models;

use Models\ConnectionModel;
use Models\MethodsHttpModel;

class DeleteModel extends MethodsHttpModel
{
    private ConnectionModel $connection;
    private string $query;
    private $prepare;

    public function delete(int $receivedId)
    {
        $this->connection = new ConnectionModel();
        $this->query = "DELETE FROM sra_products WHERE pro_id=:pro_id";
        $this->prepare = $this->connection->connectToDatabase()->prepare($this->query);
        $this->prepare->bindParam(':pro_id', $receivedId, \PDO::PARAM_INT);
        $this->prepare->execute();
        return $this->prepare->rowCount();
    }
}