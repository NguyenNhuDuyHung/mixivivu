<?php
class Connection
{
    private static $instance = null, $conn = null;

    private function __construct($config)
    {
        // connect to database
        try {
            $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'];

            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];

            $con = new PDO($dsn, $config['username'], $config['password'], $options);

            self::$conn = $con;
        } catch (PDOException $exception) {
            $mess = $exception->getMessage();

            if (preg_match('/Access denied for user/', $mess)) {
                die('Access denied');
            }

            if (preg_match('/Unknown database/', $mess)) {
                die('Database not found');
            }
        }
    }

    public static function getInstance($config)
    {
        if (self::$instance === null) {
            $connection = new Connection($config);
            self::$instance = self::$conn;
        }

        return self::$instance;
    }
}