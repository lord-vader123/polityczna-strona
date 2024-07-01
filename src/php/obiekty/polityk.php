<?php 

class polityk {
    // parametry
    private string $imie, $nazwisko, $sciezka_do_obrazu;
    private ?int $id, $id_partii, $id_komitetu;
    private bool $jest_poslem;


    public function __construct($imie, $nazwisko, $sciezka_do_obrazu, $id, $id_partii, $id_komitetu, $jest_poslem) {
        if ($id === NULL) {
            //dodaj posła do bazy danych
            return;
        }        
        $this -> $imie = $imie;
    }
    
}

?>