<?php
namespace Traits;

trait VerificationTrait
{
    public function verifyKeyExistsInArray($keySearched, array $arrayVerified)
    {
        if (array_key_exists($keySearched, $arrayVerified)) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyFileExists(string $file, string $pathToFile)
    {
        if (file_exists($pathToFile. $file)) {
            return true;
        } else {
            return false;
        }
    }
}