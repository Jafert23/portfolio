<?php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        try {
            $host_name = 'db5017372081.hosting-data.io';
            $database = 'dbs13933002';
            $user_name = 'dbu1301534';
            $password = 'Vgb!dAZu5GkNdhc';

            $this->conn = new PDO(
                "mysql:host=" . $host_name . 
                ";dbname=" . $database,
                $user_name,
                $password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
} 