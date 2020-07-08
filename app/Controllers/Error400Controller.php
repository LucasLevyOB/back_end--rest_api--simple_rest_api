<?php 
namespace Controllers;

class Error400Controller
{
    public function __construct()
    {
        echo header('HTTP/1.1 400 Bad Request');
        echo json_encode(array('response' => 'Requisicao incorreta.'));
    }
}