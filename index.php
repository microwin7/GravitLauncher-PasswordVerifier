<?php

require __DIR__ . '/vendor/autoload.php';

use Microwin7\PHPUtils\Request\Data;
use Microwin7\PHPUtils\Security\BearerToken;
use Microwin7\PasswordVerifier\CryptValidator;
use Microwin7\PHPUtils\Response\JsonResponse;

// Registration ExceptionHandler
new \Microwin7\PHPUtils\Exceptions\Handler\ExceptionHandler;

BearerToken::validateBearer() ?: throw new Exception('Incorrect BearerToken');

$data = Data::getData();

(new JsonResponse)->response(
    ['success' => (new CryptValidator())->{mb_strtolower(Data::requiredUrl() ?: 'bcrypt')}(
            $data['password'] ?? '',
            $data['encryptedPassword'] ?? ''
        )]
);
