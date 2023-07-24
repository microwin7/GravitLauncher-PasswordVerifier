<?php

namespace Microwin7\PasswordVerifier;

use Microwin7\PHPUtils\Security\Hashers\PHPass;
use Hashers\PBKDF2PasswordHasher;

class CryptValidator
{
    public static function bcrypt($password, $encryptedPassword)
    {
        return password_verify($password, $encryptedPassword);
    }
    public static function phpass($password, $encryptedPassword)
    {
        return PHPass::phpass_validation($password, $encryptedPassword);
    }
    public static function pbkdf2($password, $encryptedPassword)
    {
        $pbkdf2 = new PBKDF2PasswordHasher();
        return $pbkdf2->validate($password, $encryptedPassword);
    }
}
