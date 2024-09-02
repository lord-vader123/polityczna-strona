<?php

include __DIR__ . '/MySqlObject.php';

class Committee extends MySqlObject {
    
    public function __construct(mysqli|null $conn, int|null $id) {
        parent::__construct($conn, $id);

    }

    public function getTable(): string {
        return "Committees";
    }
    
    public function setData(array $data): bool {
        if (is_array($data) && count($data) == 1) {
            $data = [
                'name' => $data['name'],
            ];
            $this->setDataArray($data);
            return true;
        } else {
            throw new Exception('Incorrect argument provided');
        }
    }
    
    public function sendToDb(): bool {
        $data = $this->getDataArray();
        $stmt = $this->conn->prepare('INSERT INTO comittee (name) VALUES (?)');
        if (!$stmt) {
            throw new Exception('Error preparing statement');
        }
        
        $stmt->bind_param('s', $data['name']);
        
        if (!$stmt->execute()) {
            throw new Exception('Something broke while executing query');
        }
        
        $stmt->close();
        return true;
    }
}