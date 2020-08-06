<?php
namespace Controllers;

use Traits\MessageHTTPTrait;
use Traits\UrlParserTrait;
// use Models\ProductModel;
use Models\PostModel;
use Models\GetModel;
use Models\PutModel;
use Models\DeleteModel;
use Models\ProductModel;
use Models\ProductValidationModel;

class ProductController
{
    use MessageHTTPTrait;
    use UrlParserTrait;

    private string $requestMethod;
    private $requiredMethod;
    private ProductModel $product;
    private int $receivedId;
    private ProductValidationModel $validation;
    private int $success;
    private $productId;
    
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
                $this->validation->checkFields($receivedData, 'pro_name');
                $this->validation->checkFields($receivedData, 'pro_price');
                $this->validation->checkExistsErrors();
                $this->validation->checkDataIsNull($this->product->getReceivedData());
                $this->validation->checkData($this->product->getReceivedData());
                $this->validation->checkExistsErrors();
                $this->product->setReceivedData($this->validation->validateData($this->product->getReceivedData()));
                $this->requiredMethod = new PostModel();
                $this->success = $this->requiredMethod->post($this->product->getReceivedData());
                if ($this->success == true) {
                    $header = 'HTTP/1.1 201 Created';
                    $response = 'Produto inserido com sucesso!';
                    $this->sendMessageErrors($header, $response);
                }
                $header = 'HTTP/1.1 500 Internal Server Error';
                $response = 'Desculpe sua requisicao nao pode ser atendida.';
                $this->sendMessageErrors($header, $response);
                break;
            case 'GET':
                $this->validation = new ProductValidationModel();
                $this->productId = $this->getIdUrl($this->parseUrl());
                $this->requiredMethod = new GetModel();
                if (filter_var($this->productId, FILTER_VALIDATE_INT)) {
                    $this->validation->checkID($this->productId);
                    $this->validation->checkExistsErrors();
                    $this->productId = $this->validation->validateId($this->productId);
                    $dataReceivedDB = $this->requiredMethod->get($this->productId);
                    if (!$dataReceivedDB) {
                        $header = 'HTTP/1.1 200 OK';
                        $response = 'Nenhum produto encontrado.';
                        $this->sendMessageErrors($header, $response);
                    }
                    $header = 'HTTP/1.1 200 OK';
                    $response = 'Produto encontrado.';
                    $this->sendData($header, $response, $dataReceivedDB);
                }
                $dataReceivedDB = $this->requiredMethod->get();
                if (!$dataReceivedDB) {
                    $header = 'HTTP/1.1 200 OK';
                    $response = 'Nenhum produto encontrado.';
                    $this->sendMessageErrors($header, $response);
                }
                $header = 'HTTP/1.1 200 OK';
                $response = 'Produtos encontrados.';
                $this->sendData($header, $response, $dataReceivedDB);
                break;
            case 'PUT':
                $receivedData = json_decode(file_get_contents('php://input', false));
                $this->validation = new ProductValidationModel();
                $this->validation->checkFields($receivedData, 'pro_name');
                $this->validation->checkFields($receivedData, 'pro_price');
                $this->validation->checkExistsErrors();
                $this->productId = $this->getIdUrl($this->parseUrl());
                $this->product = new ProductModel($receivedData, $this->productId);
                $this->validation->checkID($this->product->getReceivedId());
                $this->validation->checkDataIsNull($this->product->getReceivedData());
                $this->validation->checkData($this->product->getReceivedData());
                $this->validation->checkExistsErrors();
                $this->product->setReceivedId($this->validation->validateId($this->product->getReceivedId()));
                $this->product->setReceivedData($this->validation->validateData($this->product->getReceivedData()));
                $this->requiredMethod = new PutModel();
                $this->success = $this->requiredMethod->put($this->product->getReceivedId(), $this->product->getReceivedData());
                if ($this->success == true) {
                    $header = 'HTTP/1.1 201 Created';
                    $response = 'Produto atualizado com sucesso!';
                    $this->sendMessageErrors($header, $response);
                }
                $header = 'HTTP/1.1 500 Internal Server Error';
                $response = 'Desculpe sua requisicao nao pode ser atendida.';
                $this->sendMessageErrors($header, $response);
                break;
            case 'DELETE':
                $this->validation = new ProductValidationModel();
                $this->productId = $this->getIdUrl($this->parseUrl());
                $this->validation->checkID($this->productId);
                $this->validation->checkExistsErrors();
                $this->productId = $this->validation->validateId($this->productId);
                $this->requiredMethod = new DeleteModel();
                $this->success = $this->requiredMethod->delete($this->productId);
                if ($this->success == true) {
                    $header = 'HTTP/1.1 200 OK';
                    $response = 'Produto deletado com sucesso!';
                    $this->sendMessageErrors($header, $response);
                }
                $header = 'HTTP/1.1 500 Internal Server Error';
                $response = 'Desculpe sua requisicao nao pode ser atendida.';
                $this->sendMessageErrors($header, $response);
                break;
            default:
                return 'aaaaa';
                break;
        }
    }

}
