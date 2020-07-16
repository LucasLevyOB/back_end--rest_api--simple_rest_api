<?php
namespace Models;

use Interfaces\ProductInterface;

class ProductModel implements ProductInterface
{
    private $receivedData;
    private int $receivedId;

    public function __construct($receivedData)
    {
        $this->receivedData = $receivedData;
    }

    protected function validateReceivedData($receivedData)
    {

    }

    public function getReceivedData()
    {
        return $this->receivedData;
    }

    public function setReceivedData(object $receivedData)
    {
        $this->receivedData = $receivedData;
    }
}