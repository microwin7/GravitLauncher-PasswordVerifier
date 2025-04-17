<?php

namespace Microwin7\PasswordVerifier;

use Microwin7\PHPUtils\Security\Hashers\PHPass;
use Hashers\PBKDF2PasswordHasher;

class CryptValidator
{
    public static function bcrypt($password, $hash)
    {
        return password_verify($password, $hash);
    }
    public static function wp_bcrypt($password, $hash)
    {
        $password_to_verify = base64_encode( hash_hmac( 'sha384', $password, 'wp-sha384', true ) );
        return password_verify($password_to_verify, substr($hash, 3));
    }
    public static function phpass($password, $hash)
    {
        return PHPass::phpass_validation($password, $hash);
    }
    public static function pbkdf2($password, $hash)
    {
        return (new PBKDF2PasswordHasher())->validate($password, $hash);
    }
}
