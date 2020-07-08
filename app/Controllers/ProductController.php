<?php
namespace Controllers;

class ProductController
{
    private string $requestMethod;
    
    public function __construct()
    {
        echo $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }
}