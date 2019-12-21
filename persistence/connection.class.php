<?php

class Connection {

    private static $instance = null;
    private static $dbName = 'lojavirtual';
    private static $dbHost = 'localhost';
    private static $dbUserName = 'root';
    private static $dbUserPassword = '';

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect() {
        if (null == self::$instance) {
            try {
                self::$instance = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUserName, self::$dbUserPassword
                        , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->exec("SET CHARACTER SET utf8");
                //self::$instance->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
            } catch (PDOException $exc) {
                echo $exc->getMessage();
            }
        }
        return self::$instance;
    }

    public static function prepare($query) {
        return self::connect()->prepare($query);
    }

    public static function select($query) {
        $STH = self::prepare($query);
        $STH->execute();
        return $STH->fetchAll();
    }

    public static function exists($query) {
        $stmt = Connection::connect()->prepare($query);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return false;
    }

    public static function execute($query) {
        $stmt = Connection::connect()->prepare($query);
        return $stmt->execute();
    }

//    public static function getInstance() {
//        if (self::$instance === null) {
//            $pdo = new PDO("mysql:host=localhost;dbname=banco", "root", "");
//            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            self::$instance = $pdo;
//        }
//        return self::$instance;
//    }
}
