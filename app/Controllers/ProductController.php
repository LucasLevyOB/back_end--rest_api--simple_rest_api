<?php
namespace Controllers;

use Models\ProductModel;

class ProductController extends ProductModel
{
    private string $requestMethod;
    
    public function __construct()
    {
        var_dump($this->get());
        // echo $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

}