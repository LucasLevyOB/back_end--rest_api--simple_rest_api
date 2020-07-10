<?php 
namespace Controllers;

use Traits\MessageHTTPTrait;

class Error500Controller
{
    use MessageHTTPTrait;

    public function __construct()
    {
        $header = 'HTTP/1.1 500 Internal Server Error';
        $response = 'Desculpe sua requisicao nao pode ser atendida.';
        $this->sendMessage($header, $response);
    }
}