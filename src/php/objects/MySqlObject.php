<?php

abstract class MySqlObject {

    public array $dbData;
    public mysqli $conn;

    public function __construct(?mysqli $conn, ?int $id) {
        if ($conn === null && $id === null) {
            return;
        } else {
            $this->conn = $conn;
            $this->dbData = $this->getDbData($conn, $id);
        }
    }
    
    public function setData(string ...$values): void {
        $sql = "DESCRIBE ".$this->getTable();
        $result = $this->conn->query($sql);

        $index = 0;
        while ($row = $result->fetch_assoc()) {
            if (isset($values[$index])) { // jeżeli argument istnieje przypisz jego wartość do talbicy
                $this->dbData[$row['Field']] = $values[$index];
                $index++;
            } else { // w przeciwnym wypadku przypisz null
               $this->dbData[$row['Field']] = null; 
            }
        }
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
}