<?php 

class polityk {
    // parametry
    private string $imie, $nazwisko, $sciezka_do_obrazu;
    private ?int $id, $id_partii, $id_komitetu;
    private bool $jest_poslem;

    public function __construct($imie, $nazwisko, $sciezka_do_obrazu, $id_partii = NULL, $id_komitetu = NULL, $jest_poslem, mysqli $conn, $id = NULL) {
        if ($id !=== NULL) {
            // pobierz dane z bazy danych
        } else {
            this -> $imie = $imie;
            this -> $nazwisko = $nazwisko;
            this -> $sciezka_do_obrazu = $sciezka_do_obrazu;
            this -> $id_partii = $id_partii;
            this -> $id_komitetu = $id_komitetu;
            this -> $jest_poslem = $jest_poslem; 
        }
    }
}

?>