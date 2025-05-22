<?php

require_once 'data/secret.php';

/*
 * SqlProvider
 * Hides interface like PDO, msqli, MSSQL, ODBC, ...
 */

class SqlProvider {

    private static $pdo = null;
    static $debug = false;

    function __construct() {
        if (self::$pdo === null) {
            $this->connect(Secret::DB_HOST, Secret::DB_NAME, Secret::DB_USERNAME, Secret::DB_PASSWORD);
        }
    }

    private function connect($host, $dbname, $user, $pass): void {
        try {
            $dsn = "mysql:dbname=$dbname;host=$host;charset=utf8"; // no hyphen in utf8
            self::$pdo = new PDO($dsn, $user, $pass, null);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die('SqlProvider connection failed: ' . $ex->getMessage());
        }
    }

    function prepare($sql) {
        return self::$pdo->prepare($sql);
    }
    
    function execute($sql, $args = []) {
        $stmt = $this->prepare($sql);
        return $stmt->execute($args);
    }

}
