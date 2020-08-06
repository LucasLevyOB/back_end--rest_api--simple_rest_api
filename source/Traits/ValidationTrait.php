<?php
namespace Traits;

trait ValidationTrait
{
    protected function checkKeyExistsInObject($keySearched, object $objectVerified)
    {
        return property_exists($objectVerified, $keySearched);
    }

    protected function checkKeyExistsInArray($keySearched, array $arrayVerified)
    {
        return array_key_exists($keySearched, $arrayVerified);
    }

    protected function checkFileExists(string $file, string $pathToFile)
    {
        return file_exists($pathToFile. $file);
    }


    // string validations
    protected function validateString(string $string)
    {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    protected function checkIsString(string $string)
    {
        return !is_numeric($string);
    }

    protected function checkMinimunLenghtString(int $lenght, string $string)
    {
        return strlen($string) >= $lenght;
    }

    protected function formatString(string $string)
    {
        $stringFormated = trim($string);
        return $stringFormated;
    }

    // float validations
    protected function checkMinimunValueFloat(float $minimunValue, float $valueChecked)
    {
        return $valueChecked >= $minimunValue;
    }

    protected function checkIsFloat($float)
    {
        return is_numeric($float);
    }

    protected function validateFloat(float $float)
    {
        $floatFormated = filter_var($float, FILTER_VALIDATE_FLOAT);
        return filter_var($floatFormated, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    protected function formatFloat(
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
    protected function checkIsInt($int)
    {
        return filter_var($int, FILTER_VALIDATE_INT);
    }

    protected function validateInt(int $int)
    {
        return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
    }
}