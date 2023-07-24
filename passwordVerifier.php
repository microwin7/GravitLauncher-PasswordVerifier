<?php

require __DIR__ . '/vendor/autoload.php';

use Microwin7\PHPUtils\Request\Data;
use Microwin7\PHPUtils\Response\ResponseConstructor;
use Microwin7\PHPUtils\Security\BearerToken;
use Microwin7\PasswordVerifier\CryptValidator;

BearerToken::validationBearer() ?: die('Incorrect BearerToken');
$cryptValidator = new CryptValidator();
$hash = mb_strtolower(Data::requiredUrl() ?: 'bcrypt');
$data = Data::getData();
$response = new ResponseConstructor;

try {
    $response->extra(
        ['success' => $cryptValidator->$hash(
            $data['password'] ?? '',
            $data['encryptedPassword'] ?? ''
        )]
    )->response();
} catch (Exception $e) {
    die($e->getMessage());
}
