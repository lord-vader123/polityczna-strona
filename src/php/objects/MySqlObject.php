<?php

abstract class MySqlObject {

    private array $dbData;
    public mysqli $conn;

    public function __construct(mysqli $conn, ?int $id) {
        $this->conn = $conn;
        $this->dbData = [];

        if ($id === null) {
            return;
        } else {
            $this->setDataArray($this->getDbData($conn, $id)) ;
            return;
        }
    }
    
    
    public function getDataArray() : array {
        return $this->dbData;
    }
    
    public  function setDataArray(array $dbData) : void {
        $this->dbData = $dbData;
    }
    
    
    private function getDbData(mysqli $conn, int $id): array {
        $sql = "SELECT * FROM ". $this->getTable(). " where id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ? $result : null;
    }
    
    
    abstract public function getTable(): string;
    abstract public function sendToDb() : bool;
    abstract public function setData(array $data) : bool;
}