<?php

include __DIR__ . '/MySqlObject.php';

class Party extends MySqlObject {
    
    public function __construct(mysqli|null $conn, int|null $id) {
        parent::__construct($conn, $id);

    }

    public function getTable(): string {
        return "parties";
    }
    
    public function setData(array $data): bool {
        if (is_array($data) && count($data) == 3) {
            $dbData = [
                'full_name' => $data['full_name'],
                'short_name' => $data['short_name'],
                'logo' => $data['logo'],
            ];
            $this->setDataArray($dbData);
            return true;
        } else {
            throw new Exception('Wrong argument provided');
        }

    }
    
    public function sendToDb(): bool {
        $dbData = $this->getDataArray();
        $sql = "INSERT INTO ". $this->getTable() ."(full_name, short_name, logo) VALUES(?, ?, ?)";
        $stmt = $this->conn->prepare($sql);         
        if ($stmt === false) {
            throw new Exception('Failed to prepare SQL statement: ' . $this->conn->error);
        }

        $stmt->bind_param("sss", $dbData['full_name'], $dbData['short_name'], $dbData['logo']);
        
        if (!$stmt->execute()) {
            throw new Exception('Failed to execute SQL statement: ' . $stmt->error);
        }
        $stmt->close();
        return true;
    }
}