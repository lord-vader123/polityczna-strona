<?php

class Table {
    private mysqli $conn;
    private array $tableArray = [];
    public function __construct(mysqli $conn, string $tableName) {
        $this->conn = $conn;
        $tableName = $this->conn->real_escape_string($tableName);

        $query = "SELECT * FROM `$tableName`";
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            throw new Exception('Statement error');
        }
        
        $stmt->execute();
        
        $data = $stmt->get_result();        
        
        while ($row = $data->fetch_assoc()) {
            if (!is_array($row)) {
                throw new Exception('Data is not an array');
            }
            $this->tableArray[] = $row;            
        }

        return;
    }
    
    public function getTableArray() : array {
        return $this->tableArray;
    }
}