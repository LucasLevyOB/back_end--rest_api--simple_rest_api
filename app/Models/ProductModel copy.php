<?php
// namespace Models;

use Models\ConnectionModel;

use Interfaces\ProductInterface;
use stdClass;
use Traits\MessageHTTPTrait;
use Traits\ValidationTrait;

class ProductModel extends ConnectionModel implements ProductInterface
{

    use MessageHTTPTrait;
    use ValidationTrait;

    private object $connection;
    private $data;
    private array $errors;

    private function setErrors(string $fieldIncorrect)
    {
        array_push($this->errors, $fieldIncorrect);
    }

    private function checkExistsErrors(array $errors)
    {
        if (count($errors) > 0) {
            $header = 'HTTP/1.1 400 Bad Request';
            $response = 'Há campos inválidos.';
            $errors = $errors;
            return $this->sendMessageErrors($header, $response, $errors);
            exit;
        }
    }

    private function checkDataIsNull($data)
    {
        if(!$data){
            $header = 'HTTP/1.1 400 Bad Request';
            $response = 'Requisicao incorreta.';
            $this->sendMessageErrors($header, $response);
        }
    }

    private function checkData(object $data)
    {
        if (!$this->checkIsString($data->pro_name)) {
            $this->setErrors('pro_name');
        } else {
            if (!$this->checkMinimunLenghtString(3, $data->pro_name)) {
                $this->setErrors('pro_name');
            }
        }
        
        if (!$this->checkIsFloat($data->pro_price)) {
            $this->setErrors('pro_price');
        } else {
            if (!$this->checkMinimunValueFloat(0, $data->pro_price)) {
                $this->setErrors('pro_price');
            }
        }

        return $data;
    }

    private function validateData(object $data)
    {
        $data->pro_name = $this->validateString($data->pro_name);

        $data->pro_name = $this->formatString($data->pro_name);

        $data->pro_price = $this->validateFloat($data->pro_price);
        
        $data->pro_price = $this->formatFloat($data->pro_price, 2, '.', '');

        return $data;
    }

    public function post()
    {
        $this->errors = array();
        $this->data = json_decode(file_get_contents('php://input', false));
        
        $this->checkDataIsNull($this->data);

        $this->data = $this->checkData($this->data);

        $this->checkExistsErrors($this->errors);

        $this->data = $this->validateData($this->data);

        var_dump($this->data);
        // $this->connection = $this->connectToDatabase();
        // $this->connection = $this->connectToDatabase()->prepare("INSERT INTO sra_products(pro_name, pro_price) VALUES(:productName, :productPrice)");
        // $this->connection->bindParam(':productName', $this->data->pro_name, \PDO::PARAM_STR);
        // $this->connection->bindParam(':productPrice', $this->data->pro_price, \PDO::PARAM_STR);
        // $this->connection->execute();
        // echo 'post';

    }

    public function get()
    {
        echo 'get';
        // $name = 'teste a <br>; 1 = 1 SELECT';
        // $price = 12.10;
        // $password = 'teste123';
        // $password = crypt($password);
        // $password = password_hash($password, PASSWORD_DEFAULT);
        // $name = filter_var($name, FILTER_VALIDATE_EMAIL);
        // $name = filter_var($name, FILTER_SANITIZE_STRING);
        // $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
        // $name = filter_var($name, FILTER_SANITIZE_EMAIL);
        // $price = filter_var($price, FILTER_VALIDATE_FLOAT);
        // $price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        // $price = filter_var($price, FILTER_FLAG_ALLOW_FRACTION);
        // $name = preg_replace('/[^[:alpha:]_]/', '', $name);
        // $price = preg_replace('/[^[:alnum:]_]/', '', $price);
        // $this->connection = $this->connectToDatabase()->prepare("INSERT INTO sra_products(pro_name, pro_price) VALUES(:name, :price)");
        // $this->connection->bindParam(':name', $name, \PDO::PARAM_STR);
        // $this->connection->bindParam(':price', $price, \PDO::PARAM_STR);
        // return $this->connection->execute();
        // var_dump($this->connection);
        // echo "<br> {$name}";
        // echo "<br> {$price}";
        // echo "<br> {$password}";
        // echo "<br>";
        // echo password_verify('teste123', $password);
    }

    public function put()
    {
        echo 'put';
    }

    public function delete()
    {
        echo 'delete';
    }
}