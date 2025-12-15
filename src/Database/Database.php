<?php

namespace App\Database;

use PDO;
use PDOException;

/**
 * Database Singleton Class
 * 
 * Ensures only one database connection exists throughout the application.
 * Uses PDO with prepared statements for security.
 */
class Database
{
    /**
     * The single instance of Database
     */
    private static ?Database $instance = null;
    
    /**
     * PDO connection
     */
    private PDO $connection;
    
    /**
     * Private constructor - prevents direct instantiation
     * Loads config and creates PDO connection
     */
    private function __construct()
    {
        $config = require dirname(__DIR__, 2) . '/config/database.php';
        
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['dbname'],
            $config['charset']
        );
        
        try {
            $this->connection = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }
    
    /**
     * Get the singleton instance
     * Creates instance on first call, returns existing instance on subsequent calls
     */
    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    /**
     * Get the PDO connection
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
    
    /**
     * Prevent cloning of the instance
     */
    private function __clone() {}
    
    /**
     * Prevent unserializing of the instance
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }
}