<?php

include __DIR__ . '/MySqlObject.php';

class User extends MySqlObject {
    
    public function __construct(mysqli $conn, ?int $id) {
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
            throw new Exception('Wrong argument provided');
        }
    }
    
    public function updateData(array $newData) : bool {
        $dbData = $this->getDataArray();
        
        foreach ($newData as $key => $value) {
            if ($value == '') {
                $newData[$key] = null;
            }
        }
        
        $newData['passphrase'] = isset($newData['passphrase']) ? password_hash($newData['passphrase'], PASSWORD_BCRYPT) : null;

        $updateData = [
            'name' => $newData['name'] ?? $dbData['name'],
            'surname' => $newData['surname'] ?? $dbData['surname'],
            'login' => $newData['login'] ?? $dbData['login'],
            'passphrase' => $newData['passphrase'] ?? $dbData['passphrase'],
        ];
        
        
        if (!isset($dbData['id'])) {
            throw new Exception('No user id provided');
        }
        
        $stmt = $this->conn->prepare('UPDATE users set name=?, surname=?, login=?, passphrase=? WHERE id=?');

        if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->conn->error);
            }

        $stmt->bind_param('ssssi', $updateData['name'], $updateData['surname'], $updateData['login'], $updateData['passphrase'], $dbData['id']);

        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            throw new Exception('No rows affected by the update.');
        }

        return true; 
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
    
    public function getUserId(?string $login = null): ?int {
        $stmt = $this->conn->prepare('SELECT id FROM users WHERE login = ?');
        if (!$stmt) {
            throw new Exception("Error in mysql statement");
        }
        $userLogin = $login === null ? $this->getDataArray()['login']  : $login;
        $stmt->bind_param('s', $userLogin);
        $stmt->execute();
        $data = $stmt->get_result();
        
        if (!$data) {
            throw new Exception('Error in getting data from database');
        }
        
        $data = $data->fetch_assoc();
        $stmt->close();


        return isset($data['id']) ? (int) $data['id'] : null;
    }
    
    public static function getUserIdByCoockies(mysqli $conn) : int | false {
        if (isset($_COOKIE['login']) && isset($_COOKIE['passphrase'])) {
            $login = $_COOKIE['login'];
            $passphrase = $_COOKIE['passphrase'];

            $stmt = $conn->prepare('SELECT id, passphrase FROM users WHERE login = ?');

            if (!$stmt) {
                throw new Exception('Error preparing statement');
            }

            $stmt->bind_param('s', $login);
            $stmt->execute();
            
            $data = $stmt->get_result()->fetch_assoc();
            
            if (!$data) {
                return false;
            }

            if (password_verify($passphrase, $data['passphrase'])) {
                return (int) $data['id'];
            }
        }
        return false;
        

    }

    public static function getUserIdBySession(mysqli $conn) : int | false {
        if (isset($_SESSION['login']) && isset($_SESSION['passphrase'])) {
            $login = $_SESSION['login'];
            $passphrase = $_SESSION['passphrase'];

            $stmt = $conn->prepare('SELECT id, passphrase FROM users WHERE login = ?');

            if (!$stmt) {
                throw new Exception('Error preparing statement');
            }

            $stmt->bind_param('s', $login);
            $stmt->execute();
            
            $data = $stmt->get_result()->fetch_assoc();
            
            if (!$data) {
                return false;
            }

            if (password_verify($passphrase, $data['passphrase'])) {
                return (int) $data['id'];
            }
        }
        return false;
    }

}