<?php
namespace model\DAO;

abstract class AbstractDAO {

    const DB_NAME = "schedule_generation";
    const DB_IP = "localhost";
    const DB_PORT = "3307";
    const DB_USER = "root";
    const DB_PASS = "";

    protected static $pdo;

    protected function __construct() {    }

    public static function init() {
        try {

            if (self::$pdo instanceof \PDO) {
                return;
            }

            self::$pdo = new \PDO("mysql:host=" . self::DB_IP . ":" . self::DB_PORT . ";dbname=" . self::DB_NAME, self::DB_USER, self::DB_PASS);
			self::$pdo->exec("set names utf8");
            self::$pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

        }
        catch (\PDOException $e){
            echo "Problem with db query  - " . $e->getMessage();
        }
    }

    public static function getPdo()
    {
        return self::$pdo;
    }
}