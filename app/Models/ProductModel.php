<?php
namespace Models;

use Models\ConnectionModel;
use Interfaces\ProductInterface;

class ProductModel extends ConnectionModel implements ProductInterface
{
    private $connection;

    public function post()
    {

    }
    
    public function get()
    {
        // $name = 'produto de teste';
        // $price = 12.00;
        // $this->connection = $this->connectToDatabase()->prepare("INSERT INTO sra_products(pro_name, pro_price) VALUES(:name, :price)");
        // $this->connection->bindParam(':name', $name, \PDO::PARAM_STR);
        // $this->connection->bindParam(':price', $price, \PDO::PARAM_STR);
        // $this->connection->execute();
        $this->connection = $this->connectToDatabase();
        return $this->connection;
    }

    public function put()
    {

    }

    public function delete()
    {

    }
}