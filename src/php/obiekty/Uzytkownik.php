<?php

// TRZEBA DODAĆ HASHOWANIE HASEŁ !!!!
class Uzytkownik extends ElementBazy {
    // parametry
    private ?int $id;
    private ?string $imie, $nazwisko, $login, $haslo;
    
    // konstruktor który w przypadku podania id wypełnia informacje danymi z bazy danych użytkownika o podanym id, w innym wypadku przypisuje dane podane w argumentach
    public function __construct($id = NULL, $imie = NULL, $nazwisko = NULL, $login = NULL, $haslo = NULL, ?mysqli $conn = NULL)  {
        if ($id !== NULL && $conn !== NULL) {
            parent::__construct($id, $conn);
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
    
    // przypisuje dane z bazy danych do parametrów klasy
    protected function przypiszDane(array $dane) : void {
        $this->id = $dane['id_uzytkownika'];
        $this->imie = $dane['imie_uzytkownika'];
        $this->nazwisko = $dane['nazwisko_uzytkownika'];
        $this->login = $dane['login_uzytkownika'];
        $this->haslo = $dane['haslo_uzytkownika'];
        return;
    }
    
    // zwraca nazwe tabele w bazie danych mysql
    protected function pobierzTabele() : string {
        return "Uzytkownicy";
    }
}

?>