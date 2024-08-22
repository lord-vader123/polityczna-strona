<?php

abstract class MySqlObject {

    private array $dbData;
    public mysqli $conn;

    public function __construct(?mysqli $conn, ?int $id) {
        if ($conn === null && $id === null) {
            return;
        } else {
            $this->conn = $conn;
            $this->dbData = $this->getDbData($conn, $id);
        }
    }
    
    
    public function getData() : array {
        return $this->dbData;
    }
    
    
    private function getDbData(?mysqli $conn, int $id): array {
        $sql = "SELECT * FROM ". $this->getTable(). " where id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: [];
    }
    
    
    abstract public function getTable(): string;
    abstract public function sendToDb() : void;
    abstract public function setData() : void;
}