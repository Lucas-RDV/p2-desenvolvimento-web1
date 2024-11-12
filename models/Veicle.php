<?php
require_once "../config/database.php";

class Veicle {
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($model, $description, $value, $km, $userid)
    {
        $sold = false;
        $sql = "INSERT INTO veicles (model, description, value, km, userID, sold)
         VALUES (:model, :description, :value, :km, :userid, :sold)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':km', $km);
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':sold', $sold);
        return $stmt->execute();
    }   

    public function list()
    {
        $sql = "SELECT * FROM veicles";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listSold()
    {
        $sql = "SELECT * FROM veicles WHERE sold = true";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listNotSold()
    {
        $sql = "SELECT * FROM veicles WHERE sold = false";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM veicles WHERE userID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id,$model, $description, $value, $km, $userid, $sold)
    {
        $sql = "UPDATE veicles SET 
         model= :model, description = :description, value = :value, km = :km, 
        userid = :userid, sold = :sold
         WHERE userID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':km', $km);
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':sold', $sold);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM veicles WHERE userID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}