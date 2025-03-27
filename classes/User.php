<?php 
class User {
    private $connection;
    private $table = 'users';

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    public function read()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function update($data)
    {
        $sql = "UPDATE {$this->table} SET name = :name, email = :email, password = :password WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($data)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }
}