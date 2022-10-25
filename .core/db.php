<?php

include($_SERVER['DOCUMENT_ROOT'] . "/DesignPatterns/Singleton.php");

class Database
{
    use SingletonTrait;

    private $conn = null;


    private static function initConnection()
    {
        $db = self::getInstance();
        $db_host = 'localhost'; // ваш хост
        $db_name = 'inteview'; // ваша бд
        $db_user = 'root'; // пользователь бд
        $db_pass = 'HW3a94kx'; // пароль к бд
        $db->conn = new mysqli($db_host, $db_user, $db_pass, $db_name); // коннект с сервером бд
        $db->conn->set_charset('utf8');
        return $db;
    }

    public static function GetConnection()
    {
        try {
            $db = self::initConnection();
            return $db->conn;
        } catch (Exception $ex) {
            echo "I was unable to open a connection to the database. " . $ex->getMessage();
            return null;
        }
    }
}