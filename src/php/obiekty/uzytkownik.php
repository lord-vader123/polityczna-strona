<?php

class Uzytkownik {
    private ?int $id;
    private string $imie, $nazwisko, $login, $haslo;
    
    public function __construct($imie = NULL, $nazwisko = NULL, $login = NULL, $haslo = NULL, $id = NULL, ?mysqli $conn = NULL) {
        if ($id !== NULL && $conn === NULL) {
            $this -> id = $id;
            $this -> imie = $imie;
            $this -> nazwisko = $nazwisko;
            $this -> login = $login;
            $this -> haslo = $haslo;
        } elseif ($conn !== NULL && $id !== NULL) {
            $this -> pobierzDaneZBazyDanych($conn, $id);

       }
    }
    
    public function wyslijDoBazyDanych(mysqli $conn) {
        $query = "INSERT INTO Uzytkownicy (id_uzytkownika, imie_uzytkownika, nazwisko_uzytkownika, login_uzytkownika, haslo_uzytkownika) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn -> prepare($query);
        $stmt -> bind_param("isss", $this -> $id, $this -> imie, $this -> nazwisko, $this -> login, $this -> haslo);

        if ($stmt -> execute()) {
            echo "Pomyślnie dodano użytkownika!";
        } else {
            echo "Wystąpił błąd podczas dodawania użytkownika";
        }
    }
    
    private function pobierzDaneZBazyDanych(mysqli $conn, int $id) {
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
    }
    

}

?>