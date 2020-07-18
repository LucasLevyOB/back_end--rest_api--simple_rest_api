<?php
namespace Controllers;

use Traits\MessageHTTPTrait;
// use Models\ProductModel;
use Models\PostModel;
use Models\GetModel;
use Models\ProductModel;
use Models\ProductValidationModel;

class ProductController
{
    use MessageHTTPTrait;

    private string $requestMethod;
    private $requiredMethod;
    private ProductModel $product;
    private int $receivedId;
    private ProductValidationModel $validation;
    private int $success;
    
    public function __construct()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->controllerProduct($this->requestMethod);
    }
    
    private function controllerProduct($method)
    {
        switch($method){
            case 'POST':
                $receivedData = json_decode(file_get_contents('php://input', false));
                $this->product = new ProductModel($receivedData);
                $this->validation = new ProductValidationModel();
                $this->validation->checkDataIsNull($this->product->getReceivedData());
                $this->validation->checkData($this->product->getReceivedData());
                $this->validation->checkExistsErrors();
                $this->product->setReceivedData($this->validation->validateData($this->product->getReceivedData()));
                $this->requiredMethod = new PostModel();
                $this->success = $this->requiredMethod->post($this->product->getReceivedData());
                if ($this->success == 0) {
                    $header = 'HTTP/1.1 500 Internal Server Error';
                    $response = 'Desculpe sua requisicao nao pode ser atendida.';
                    $this->sendMessageErrors($header, $response);
                }
                $header = 'HTTP/1.1 201 Created';
                $response = 'Produto inserido com sucesso!';
                $this->sendMessageErrors($header, $response);
                break;
            case 'GET':
                $this->requiredMethod = new GetModel();
                return var_dump($this->requiredMethod->get());
                break;
            case 'PUT':
                // return $this->put();
                break;
            case 'DELETE':
                // return $this->delete();
                break;
            default:
                return 'aaaaa';
                break;
        }
    }

}