<?php
namespace Interfaces;

interface MethodsHttpInterface
{
    public function post(object $receivedData);
    public function get(int $receivedId = null);
    public function put(int $receivedId, object $receivedData);
    public function delete(int $receivedId);
}