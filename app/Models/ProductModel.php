<?php
namespace Models;

use Interfaces\ProductInterface;

class ProductModel implements ProductInterface
{
    private $receivedData;
    private int $receivedId;

    public function __construct($receivedData, $receivedId = 0)
    {
        $this->receivedData = $receivedData;
        $this->receivedId = $receivedId;
    }
    
    public function getReceivedData()
    {
        return $this->receivedData;
    }

    public function setReceivedData(object $receivedData)
    {
        $this->receivedData = $receivedData;
    }

    public function getReceivedId()
    {
        return $this->receivedId;
    }

    public function setReceivedId($receivedId)
    {
        $this->receivedId = $receivedId;
    }
}
