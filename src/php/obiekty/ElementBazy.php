<?php

abstract class ElementBazy {
    protected ?int $id;
    protected ?mysqli $conn;
    
    public function __construct($id = NULL, $conn = NULL) { // jeżeli podano id obiekt istenieje i należy pobrać jego parametry z bazy danych 
        if ($id !== NULL && $conn !== NULL) {
            $this->pobierzDaneZBazyDanych($id, $conn);
        } else {
            $this->id = $id;
        }
    }

    // wykonuje kwerendę na bazie danych 
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
    
        abstract protected function przypiszDane(array $dane): void; // przypisuje odpowiednio dane z bazy danych do parametrów obiektu

        abstract protected function pobierzTabele(): string; // nazwa tabeli z której pobieramy dane
    }

?>