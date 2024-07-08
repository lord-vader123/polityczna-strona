<?php

abstract class ElementBazy {
    protected ?int $id;
    protected ?mysqli $conn;
    
    public function __construct($id = NULL, $conn = NULL) {
        if ($id !== NULL && $conn !== NULL) {
            $this->pobierzDaneZBazyDanych($id, $conn);
        } else {
            $this->id = $id;
        }
    }

    private function pobierzDaneZBazyDanych(int $id, mysqli $conn): void {
            $query = "SELECT * FROM " . $this->pobierzTabele() . " WHERE id_uzytkownika = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $dane = $result->fetch_assoc();
                $this->przypiszDane($dane);
            } else {
                echo "Nie znaleziono rekordu o podanym ID";
            }

            $stmt->close();
            $result->close();
        }
    
        abstract protected function przypiszDane(array $dane): void;

        abstract protected function pobierzTabele(): string;
    }

?>