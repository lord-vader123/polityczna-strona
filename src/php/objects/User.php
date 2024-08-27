<?php

include __DIR__ . '/MySqlObject.php';

class User extends MySqlObject {
    
    public function __construct(mysqli|null $conn, int|null $id) {
        parent::__construct($conn, $id);

    }

    public function getTable(): string {
        return "users";
    }
    
    // wysyła dane z $dbData do bazy danych
    public function sendToDb(): void{
        $dbData = $this->getDataArray();
        $sql = "INSERT INTO ". $this->getTable() ."(name, surname, login, passphrase) VALUES(?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);         
        if ($stmt === false) {
            throw new Exception('Failed to prepare SQL statement: ' . $this->conn->error);
        }

        $stmt->bind_param("ssss", $dbData['name'], $dbData['surname'], $dbData['login'], $dbData['passphrase']);
        
        if (!$stmt->execute()) {
            throw new Exception('Failed to execute SQL statement: ' . $stmt->error);
        }
        $stmt->close();
        return;
    }
    
    // Przypisuje dane w $arr do odpowiednich pól tablicy $dbData
    public function setData($arr): void {
        $dbData = $this->getDataArray();
        if (count($arr) == 4) {
            $dbData['name'] = $arr['name'];
            $dbData['surname'] = $arr['surname'];
            $dbData['login'] = $arr['login'];
            $dbData['passphrase'] = $arr['passphrase'];
            $this->setDataArray($dbData);
        } else {
            throw new Exception('Array has wrong ammount of fields');
        }
    }
}