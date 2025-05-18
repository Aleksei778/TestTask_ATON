<?php
header('Content-Type: text/html; charset=utf-8');
class Database {
    protected $pdo;
    private $config;
    private static $instance = null;

    public function __construct() {
        $this->config = require_once __DIR__ . '/../config.php';
    
        try {
            $dsn = "mysql:host={$this->config['host']};dbname={$this->config['database']};charset=utf8mb4";
            
            // Опции для PDO
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            
            $this->pdo = new PDO($dsn, $this->config['username'], $this->config['password'], $options);
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            return self::$instance = new self();
        }
        return self::$instance;
    }

    public function query($sql, $params = array()): bool|PDOStatement {
        try {
            $stmt = $this->pdo->prepare(query: $sql);
            $stmt->execute(params: $params);
            return $stmt;
        } catch (PDOException $e) {
            die("Запрос неуспешный: " . $e->getMessage());
        }
    }

    public function fetchAll($sql, $params = array()): array {
        $stmt = $this->query(sql: $sql, params: $params);
        return $stmt->fetchAll();
    }

    public function fetchColumn($sql, $params = array()): mixed {
        $stmt = $this->query(sql: $sql, params: $params);
        return $stmt->fetch();
    }

    public function __destruct() {
        $this->pdo = null;
    }
}