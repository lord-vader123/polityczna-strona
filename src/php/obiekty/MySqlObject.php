<?php

abstract class MySqlObject {

    public array $db_data;

    public function __construct(?mysqli $conn, ?int $id) {
        if ($conn === null && $id === null) {
            return;
        } else {
            $this->db_data = $this->getDbData($conn, $id);
        }
    }
    
    private function getDbData(?mysqli $conn, int $id): array {
        $sql = "SELECT * FROM". $this->getTable(). " where id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    abstract public function getTable(): string;
    
}