<?php

include __DIR__ . '/MySqlObject.php';

class Party extends MySqlObject {
    
    public function __construct(mysqli|null $conn, int|null $id) {
        parent::__construct($conn, $id);

    }

    public function getTable(): string {
        return "Parties";
    }
}