<?php

// TRZEBA DODAĆ HASHOWANIE HASEŁ !!!!
class uzytkownik {
    // parametry
    private ?int $id;
    private ?string $imie, $nazwisko, $login, $haslo;
    
    // konstruktor który w przypadku podania id wypełnia informacje danymi z bazy danych użytkownika o podanym id, w innym wypadku przypisuje dane podane w argumentach
    public function __construct($id = NULL, $imie = NULL, $nazwisko = NULL, $login = NULL, $haslo = NULL, ?mysqli $conn = NULL)  {
        if ($id !== NULL) {
            $this -> pobierzDaneZBazyDanych($conn, $id);
            return;
        }

        $this -> id = $id;
        $this -> imie = $imie;
        $this -> nazwisko = $nazwisko;
        $this -> login = $login;
        $this -> haslo = $haslo;
    }
    
    // funkcja która wysyła parametry obiektu do bazy danych
    public function wyslijDoBazyDanych(mysqli $conn) : void {
        $query = "INSERT INTO Uzytkownicy (id_uzytkownika, imie_uzytkownika, nazwisko_uzytkownika, login_uzytkownika, haslo_uzytkownika) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn -> prepare($query);
        $stmt -> bind_param("issss", $this -> $id, $this -> imie, $this -> nazwisko, $this -> login, $this -> haslo);

        if ($stmt -> execute()) {
            echo "Pomyślnie dodano użytkownika!";
        } else {
            echo "Wystąpił błąd podczas dodawania użytkownika";
        }
        $stmt -> close();
    }
    
    // funkcja która przypisuje do parametrów obiektu dane z bazy danych o podanym id 
    private function pobierzDaneZBazyDanych(mysqli $conn, int $id) : void {
        $query = "SELECT * FROM Uzytkownicy WHERE id_uzytkownika = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $dane = $result->fetch_assoc();
            $this->id = $dane['id_uzytkownika'];
            $this->imie = $dane['imie_uzytkownika'];
            $this->nazwisko = $dane['nazwisko_uzytkownika'];
            $this->login = $dane['login_uzytkownika'];
            $this->haslo = $dane['haslo_uzytkownika'];
        } else {
            echo "Nie znaleziono użytkownika o podanym ID";
        }
        
        $stmt -> close();
        $reult -> close();
    }
    
}

?>