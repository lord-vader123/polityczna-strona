<?php 

class polityk {
    // parametry
    private string $imie, $nazwisko, $sciezka_do_obrazu;
    private ?int $id, $id_partii, $id_komitetu;
    private bool $jest_poslem;


    public function __construct($imie, $nazwisko, $sciezka_do_obrazu, $id, $id_partii, $id_komitetu, $jest_poslem) {
        if ($id === NULL) {
            // Dodaj posła do bazy danych
            return;
        } else {
            // Ustaw istniejące dane
            $this->id = $id;
            $this->id_partii = $id_partii;
            $this->id_komitetu = $id_komitetu;
            $this->jest_poslem = $jest_poslem;
        }
        
        $this->imie = $imie;
        $this->nazwisko = $nazwisko;
        $this->sciezka_do_obrazu = $sciezka_do_obrazu;
    }
}

?>