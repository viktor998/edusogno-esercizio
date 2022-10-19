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

class EmailService
{
    private static $subject = 'Reset Password';
    private static $headers = [
        'From: webmaster@example.com',
        'Reply-To: webmaster@example.com',
        "X-Mailer: PHP/'phpversion()'",
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=iso-8859-1'
    ];


    public static function sendEmail($to,$message)
    {
        $success = mail($to, self::$subject, $message, implode("\r\n", self::$headers));
        if (!$success) {
            exit(error_get_last()['message']);
        }
    }
}
