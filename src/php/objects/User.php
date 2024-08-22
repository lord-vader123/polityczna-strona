<?php

class User extends MySqlObject {
    
    public function __construct(mysqli|null $conn, int|null $id) {
        parent::__construct($conn, $id);

    }

    public function getTable(): string {
        return "Users";
    }
    
    public function sendToDb(): void{
        $dbData = $this->getData();
        $sql = "INSERT INTO ". $this->getTable() ."(name, surname, login, passphrase) VALUES(????)";
        $stmt = $this->conn->prepare($sql);         
        $stmt->bind_param($dbData['name'], $dbData['surname'], $dbData['login'], $dbData['passphrase']);
        $stmt->execute();
        $stmt->close();
        return;
    }
}