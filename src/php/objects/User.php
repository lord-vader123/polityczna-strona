<?php

class User extends MySqlObject {
    
    public function __construct(mysqli|null $conn, int|null $id) {
        parent::__construct($conn, $id);

    }

    public function getTable(): string {
        return "Users";
    }
    
    public function sendToDb(): void{
        $sql = "INSERT INTO ". $this->getTable() ."(name, surname, login, passphrase) VALUES(????)";
        $stmt = $this->conn->prepare($sql);         
        $stmt->bind_param($this->dbData['name'], $this->dbData['surname'], $this->dbData['login'], $this->dbData['passphrase']);
        $stmt->execute();
        $stmt->close();
        return;
    }
}