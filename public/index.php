<?php

ini_set('error_reporting', E_ALL); // FULL DEBUG
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';

use Microwin7\PHPUtils\Request\Data;
use Microwin7\PHPUtils\Security\BearerToken;
use Microwin7\PasswordVerifier\CryptValidator;
use Microwin7\PHPUtils\Response\JsonResponse;

// Registration ExceptionHandler
new \Microwin7\PHPUtils\Exceptions\Handler\ExceptionHandler;

new BearerToken;

$data = Data::getData();

$crypt = match(substr($data['encryptedPassword'], 0, 3)) {
    '$wp' => 'wp_bcrypt',
    '$P$','$H$' => 'phpass',
    '$2y' => 'bcrypt',
    'pbk' => 'pbkdf2'
};
(new JsonResponse)->response(
    ['success' => (new CryptValidator())->{$crypt}(
        $data['password'] ?? '',
        $data['encryptedPassword'] ?? ''
    )]
);

