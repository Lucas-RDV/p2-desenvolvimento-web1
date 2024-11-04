<?php
require_once "../config/database.php";

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name, $password, $email, $cpf, $phone, $city, $estate)
    {
        $sql = "INSERT INTO users (name, password, email, cpf, phone, city, estate)
         VALUES (:name, :password, :email, :cpf, :phone, :city, :estate)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':estate', $estate);
        return $stmt->execute();
    }

    public function list()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $password, $email, $cpf, $phone, $city, $estate)
    {
        $sql = "UPDATE users SET 
        name = :name, password = :password, email = :email, cpf = :cpf, 
        phone = :phone, city = :city, estate = :estate
         WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':estate', $estate);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
