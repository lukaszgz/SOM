<?php
// session_start();
require_once('debug.php');

$DbHost = 'localhost';
$DbUser = 'root';
$DbPass = '';
$BdName = 'som';

$mysqli = new mysqli($DbHost, $DbUser, $DbPass, $BdName);
if ($mysqli->connect_errno) 
{
    $error_info = base64_encode ("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
    header('Location: error.php?msg='.$error_info);
}
else
{
    $mysqli->set_charset("utf8");
    // $mysqli->close();
}

class DB
{
    static private $DbHost = 'localhost';
    static private $DbUser = 'root';
    static private $DbPass = '';
    static private $BdName = 'som';
    static private $mysqli;
    static private $error;

    static function query($sql)
    {
        if(!isset(self::$mysqli))
        {
            // logwrite(print_r(self::$mysqli));
            self::$mysqli = new mysqli(self::$DbHost, self::$DbUser, self::$DbPass, self::$BdName);

            if (self::$mysqli->connect_errno) 
            {
                $error_info = base64_encode ("Failed to connect to MySQL: (" . self::$mysqli->connect_errno . ") " . self::$mysqli->connect_error);
                header('Location: error.php?msg='.$error_info);
            }
            else
            {
                self::$mysqli->set_charset("utf8");
            }
            
        }
        
        try
        {
            $result = self::$mysqli->query($sql);
        }
        catch(Exception $e)
        {
            self::$error = $e->getMessage();
            return false;
        }
        return $result;
    }


    function __destruct()
    {
        // logwrite("rozlaczono z baza danych");
        self::$mysqli->close();
    }



}


?>