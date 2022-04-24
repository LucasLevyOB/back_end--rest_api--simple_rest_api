<?php 
namespace Controllers;

use Traits\MessageHTTPTrait;

class Error400Controller
{
    use MessageHTTPTrait;

    public function __construct()
    {
        $header = 'HTTP/1.1 400 Bad Request';
        $response = 'Requisicao incorreta.';
        $this->sendMessageErrors($header, $response);
    }
}