<?php
namespace Traits;

trait ValidationTrait
{
    public function checkKeyExistsInArray($keySearched, array $arrayVerified)
    {
        return array_key_exists($keySearched, $arrayVerified);
    }

    public function checkFileExists(string $file, string $pathToFile)
    {
        return file_exists($pathToFile. $file);
    }


    // string validations
    public function validateString(string $string)
    {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    public function checkIsString(string $string)
    {
        return !is_numeric($string);
    }

    public function checkMinimunLenghtString(int $lenght, string $string)
    {
        return strlen($string) >= $lenght;
    }

    public function formatString(string $string)
    {
        $stringFormated = trim($string);
        return $stringFormated;
    }

    // float validations
    public function checkMinimunValueFloat(float $minimunValue, float $valueChecked)
    {
        return $valueChecked >= $minimunValue;
    }

    public function checkIsFloat($float)
    {
        return is_numeric($float);
    }

    public function validateFloat(float $float)
    {
        $floatFormated = filter_var($float, FILTER_VALIDATE_FLOAT);
        return filter_var($floatFormated, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    public function formatFloat(
        float $float, 
        int $decimalPlaces, 
        string $decimalPoint, 
        string $thousandsPoint
    ) {
        return number_format(
            $float, 
            $decimalPlaces, 
            $decimalPoint, 
            $thousandsPoint
        );
    }

    // int validations
    public function checkIsInt(int $int)
    {
        return filter_var($int, FILTER_VALIDATE_INT);
    }

    public function validateInt(int $int)
    {
        return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
    }
}