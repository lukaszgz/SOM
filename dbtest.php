<?php
// session_start();

$DbHost = '';
$DbUser = '';
$DbPass = '!';
$BdName = '';

$mysqli = new mysqli($DbHost, $DbUser, $DbPass, $BdName);
if ($mysqli->connect_errno) 
{
    // $error_info = base64_encode ("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
    echo $mysqli->connect_errno;
    echo $mysqli->connect_error;
    // echo $error_info;
    // header('Location: error.php?msg='.$error_info);
}
else
{
    $mysqli->set_charset("utf8");
    echo "ok";
}


class DB
{
    static private $DbHost = 'lukaszgz_lukasz';
    static private $DbUser = 'lukaszgz_lukasz';
    static private $DbPass = '';
    static private $BdName = '';
    static private $mysqli;

    static function query($sql)
    {
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

        try
        {
            $result = self::$mysqli->query($sql);
        }
        catch(Exception $e)
        {
            $error = $e->getMessage();
            return false;
        }

        self::$mysqli->close();

        return $result;
    }
}


?>