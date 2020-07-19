<?php
namespace Models;

use Models\ErrorModel;

use Traits\MessageHTTPTrait;
use Traits\ValidationTrait;

class ProductValidationModel
{
    use MessageHTTPTrait;
    use ValidationTrait;

    private ErrorModel $errors;

    public function __construct()
    {
        $this->errors = new ErrorModel();
    }

    public function checkExistsErrors()
    {
        if (count($this->errors->getErrors()) > 0) {
            $header = 'HTTP/1.1 400 Bad Request';
            $response = 'Há campos inválidos.';
            $errors = $this->errors->getErrors();
            return $this->sendMessageErrors($header, $response, $errors);
            exit;
        }
    }

    public function checkDataIsNull($data)
    {
        if(!$data){
            $header = 'HTTP/1.1 400 Bad Request';
            $response = 'Requisicao incorreta.';
            $this->sendMessageErrors($header, $response);
        }
    }

    public function checkData(object $data)
    {
        if (!$this->checkIsString($data->pro_name)) {
            $this->errors->setErrors('pro_name');
        } else {
            if (!$this->checkMinimunLenghtString(3, $data->pro_name)) {
                $this->errors->setErrors('pro_name');
            }
        }
        
        if (!$this->checkIsFloat($data->pro_price)) {
            $this->errors->setErrors('pro_price');
        } else {
            if (!$this->checkMinimunValueFloat(0, $data->pro_price)) {
                $this->errors->setErrors('pro_price');
            }
        }

        // return $data;
    }

    public function validateData(object $data)
    {
        $data->pro_name = $this->validateString($data->pro_name);

        $data->pro_name = $this->formatString($data->pro_name);

        $data->pro_price = $this->validateFloat($data->pro_price);
        
        $data->pro_price = $this->formatFloat($data->pro_price, 2, '.', '');

        return $data;
    }

    public function validateID($id)
    {
        return $this->checkIsInt($id) && $id > 0;
    }
}