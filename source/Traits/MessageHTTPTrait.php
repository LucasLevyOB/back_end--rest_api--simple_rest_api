<?php
namespace Traits;

trait MessageHTTPTrait
{
    public function sendMessageErrors(string $header, string $response, array $errors = null)
    {
        header($header);
        if ($errors != null) {
            echo json_encode(array('response' => $response, 'fields' => $errors));
            exit;
        }
        echo json_encode(array('response' => $response));
        exit;
    }
}