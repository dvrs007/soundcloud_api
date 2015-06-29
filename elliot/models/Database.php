<?php

class Database {
    private static $dsn = 'mysql:host=localhost;dbname=bowjia5_soundcloud';
    private static $dbUser= 'bowjia5_eg';
    private static $dbPwd = 'M5-sabugor';

    private static $dbCon;
    private function __construct() {}

    //return reference to pdo object
    public static function connectDB () {
    	
        if (!isset(self::$db)) {
            try {
                self::$dbCon = new PDO(self::$dsn,
                                     self::$dbUser,
                                     self::$dbPwd);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                exit();
            }
        }
        return self::$dbCon;
    }
}