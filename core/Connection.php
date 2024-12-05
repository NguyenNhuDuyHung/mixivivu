<?php
class Connection
{
    private static $instance = null, $conn = null; // static: dùng chung cho các lớp khác, không phải tạo mới

    private function __construct($config)
    {
        // connect to database
        try {
            $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname']; 

            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // xử lý ngoại lệ
            ];

            $con = new PDO($dsn, $config['username'], $config['password'], $options); // connect PDO

            self::$conn = $con; // save connection to static variable $conn
        } catch (PDOException $exception) {
            $mess = $exception->getMessage();

            // check error
            if (preg_match('/Access denied for user/', $mess)) { 
                die('Access denied');
            }

            if (preg_match('/Unknown database/', $mess)) {
                die('Database not found');
            }
        }
    }

    // Phương thức tĩnh static: cho phép gọi trực tiếp mà không cần tạo đối tượng của lớp => Tạo và trả về kết nối duy nhất cho CSDL 
    public static function getInstance($config)
    {
        // check if instance is null
        if (self::$instance === null) {
            $connection = new Connection($config); // tạo đối tượng Connection
            self::$instance = self::$conn; // save connection to static variable $instance
        }

        return self::$instance; // return connection
    }
}