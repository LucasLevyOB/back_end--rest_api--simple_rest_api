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
            $response = 'Desculpe houve um erro.';
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

    public function checkFields(object $data, $field)
    {
        if (!$this->checkKeyExistsInObject($field, $data)) {
            $this->errors->setErrors('O campo '. $field. ' está incorreto');
        }
    }

    public function checkData(object $data)
    {
        if (!$this->checkIsString($data->pro_name)) {
            $this->errors->setErrors('pro_name deve ser uma string');
        } else {
            if (!$this->checkMinimunLenghtString(3, $data->pro_name)) {
                $this->errors->setErrors('pro_name deve ser maior que 3');
            }
        }
        
        if (!$this->checkIsFloat($data->pro_price)) {
            $this->errors->setErrors('pro_price deve ser float');
        } else {
            if (!$this->checkMinimunValueFloat(0, $data->pro_price)) {
                $this->errors->setErrors('pro_price dever ser maior que 0');
            }
        }
    }

    public function validateData(object $data)
    {
        $data->pro_name = $this->validateString($data->pro_name);

        $data->pro_name = $this->formatString($data->pro_name);

        $data->pro_price = $this->validateFloat($data->pro_price);
        
        $data->pro_price = $this->formatFloat($data->pro_price, 2, '.', '');

        return $data;
    }

    public function checkID($id)
    {
        if ($this->checkIsInt($id) && $id > 0) {
            return true;
        }
        $this->errors->setErrors('pro_id');
        return false;
    }

    public function validateId(int $id)
    {
        return $this->validateInt($id);
    }
}
