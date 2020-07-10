<?php
namespace Traits;

trait MessageHTTPTrait
{
    public function sendMessage(string $header, string $response)
    {
        header($header);
        echo json_encode(array('response' => $response));
    }
}