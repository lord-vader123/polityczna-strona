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
    public function sendToDb(): bool{
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
        return true;
    }
    
    // Przypisuje dane w $arr do odpowiednich pól tablicy $dbData
    public function setData(array $arr): bool {
        if (count($arr) == 4 && is_array($arr)) {
            $dbData = $this->getDataArray();
            $passphrase = password_hash($arr['passphrase'], PASSWORD_BCRYPT);
            $dbData['name'] = $arr['name'];
            $dbData['surname'] = $arr['surname'];
            $dbData['login'] = $arr['login'];
            $dbData['passphrase'] = $passphrase;          
            $this->setDataArray($dbData);
            return true;
        } else {
            throw new Exception('Array has wrong ammount of fields');
        }
    }
    
    public function verifyData(string $login, string $password): bool {
        $stmt = $this->conn->prepare('SELECT login, passphrase FROM users WHERE login=?');
        $stmt->bind_param('s', $login);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        
        if (password_verify($password, $data['passphrase']) && $login == $data['login']) {
            return true;
        }
        return false;
    }
    
    public function checkLoginAvailability(string $login): bool {
        $sql = 'SELECT login FROM users WHERE login=?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $login);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        
        return $data === null;
        
    }
    
    public function getUserId(): ?int {
        $stmt = $this->conn->prepare('SELECT id FROM users WHERE login = ?');
        if (!$stmt) {
            throw new Exception("Error in mysql statement");
        }
        $stmt->bind_param('s', $this->dbData['login']);
        $stmt->execute();
        $data = $stmt->get_result();
        
        if (!$data) {
            throw new Exception('Error in getting data from database');
        }
        
        $data = $data->fetch_assoc();
        $stmt->close();


        if (isset($data['id']) && $data) {
            return (int) $data['id'];
        }
        return null;
    }

}