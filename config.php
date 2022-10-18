<?php
class MysqliService
{
    public static $host = "127.0.0.1";
    public static $username = 'root';
    public static $password = 'root';
    public static $db = 'test-edusogno';
    public static $port = '3306';

    public static function connetti()
    {
        $mysql = mysqli_connect(self::$host, self::$username, self::$password, self::$db, self::$port);
        if ($mysql->connect_errno) {
            exit('Connection error: ' . $mysql->connect_error);
        };
        return $mysql;
    }

    public static function request($query, $typeQuery)
    {
        $mysql = self::connetti();
        if ($typeQuery === 'INSERT') {
            if (false === mysqli_query($mysql, $query)) {
                exit("Errore: impossibile eseguire la query. " . mysqli_error($mysql));
            };
            return;
        };
        if ($typeQuery === 'SELECT') {
            $response = mysqli_query($mysql, $query);
            if (!$response->num_rows <= 0) {
                mysqli_close($mysql);                
                return $response;
            } else {
                mysqli_close($mysql);
                return false;
            }
        }
        mysqli_close($mysql);
    }
}
