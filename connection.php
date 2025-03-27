<?php

class DatabaseConnection
{
    private $host = 'localhost';
    private $dbName = 'your_database_name';
    private $username = 'your_username';
    private $password = 'your_password';
    private $connection;

    public function connect()
    {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->dbName}",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function disconnect()
    {
        $this->connection = null;
    }
}