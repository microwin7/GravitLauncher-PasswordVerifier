<?php

start();

class Config
{
    /** @var string */
    private const BEARER = "aaa";
    public const PHPASS_ITOA64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    public static function validationBearer(): bool
    {
        return Occurrences::getBearer() === self::BEARER;
    }
}
class Occurrences
{
    public static function getBearer(): string
    {
        return substr(getallheaders()['Authorization'], 7);
    }
    public static function requiredUrl(): string
    {
        return $_SERVER['QUERY_STRING'];
    }
    public static function getData()
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}
class CryptValidator
{
    public static function bcrypt($password, $encryptedPassword)
    {
        return password_verify($password, $encryptedPassword);
    }
    public static function phpass($password, $encryptedPassword)
    {
        return Utils::phpass($password, $encryptedPassword);
    }
    public static function pbkdf2($password, $encryptedPassword)
    {
        require_once 'Hashers/PBKDF2PasswordHasher.php';
        $pbkdf2 = new PBKDF2PasswordHasher();
        return $pbkdf2->validate($password, $encryptedPassword);
    }
}
class Utils
{
    public static function phpass($password, $encryptedPassword)
    {
        $id = substr($encryptedPassword, 0, 3);
        $entry = strpos(Config::PHPASS_ITOA64, $encryptedPassword[3]);
        $salt = substr($encryptedPassword, 4, 8);
        $hash = substr($encryptedPassword, 12);
        if ($id !== '$P$' && $id !== '$H$')
            response(false);
        
        if ($entry < 7 || $entry > 30) {
            // Восстановить при необходимости
        }
        $count = 1 << $entry;
        $hash_new = md5($salt . $password, TRUE);
        do {
            $hash_new = md5($hash_new . $password, TRUE);
        } while (--$count);
        $enc = self::enc64($hash_new, 16);
        return $enc === $hash;
    }
    private static function enc64($input, $count)
    {
        $itoa64 = Config::PHPASS_ITOA64;
        $output = '';
        $i = 0;
        do {
            $value = ord($input[$i++]);
            $output .= $itoa64[$value & 0x3f];
            if ($i < $count)
                $value |= ord($input[$i]) << 8;
            $output .= $itoa64[($value >> 6) & 0x3f];
            if ($i++ >= $count)
                break;
            if ($i < $count)
                $value |= ord($input[$i]) << 16;
            $output .= $itoa64[($value >> 12) & 0x3f];
            if ($i++ >= $count)
                break;
            $output .= $itoa64[($value >> 18) & 0x3f];
        } while ($i < $count);
        return $output;
    }
}
function start()
{
    Config::validationBearer() ?: die;
    $cv = new CryptValidator();
    $hash = mb_strtolower(Occurrences::requiredUrl() ?: 'bcrypt');
    $data = Occurrences::getData();
    $password = $data['password'];
    $encryptedPassword = $data['encryptedPassword'];
    response($cv->$hash($password, $encryptedPassword));
}
function response($success = false)
{
    header("Content-Type: application/json; charset=UTF-8");
    die(json_encode((object) array('success' => $success), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}
