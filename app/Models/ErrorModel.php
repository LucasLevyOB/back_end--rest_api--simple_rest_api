<?php
namespace Models;

class ErrorModel
{
    private array $errors;

    public function __construct()
    {
        $this->errors = array();
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors(string $error)
    {
        array_push($this->errors, $error);
    }
}