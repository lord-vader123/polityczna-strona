<?php 

class Polityk extends ElementBazy{
    // parametry
    private string $imie, $nazwisko, $sciezka_do_obrazu;
    private ?int $id, $id_partii, $id_komitetu;
    private bool $jest_poslem;

    public function __construct($imie, $nazwisko, $sciezka_do_obrazu, $id_partii = NULL, $id_komitetu = NULL, $jest_poslem, mysqli $conn = NULL, $id = NULL) {
        if ($id !== NULL && $conn !== NULL) {
            parent::__construct($id, $conn);
        } else {
            $this->id = $id;
            $this->imie = $imie;            
            $this->nazwisko = $nazwisko;
            $this->id_partii = $id_partii;
            $this->id_komitetu = $id_komitetu;
            $this->jest_poslem = $jest_poslem;
        }

    }
    
    protected function przypiszDane(array $dane): void {
        $this->id = $dane['id_polityka'];
        $this->imie = $dane['imie_polityka'];
        $this->nazwisko = $dane['nazwisko_polityka'];
        $this->id_partii = $dane['id_partii'];
        $this->id_komitetu = $dane['id_komitetu'];
        $this->jest_poslem = $dane['jest_poslem'];
        
    }

    protected function pobierzTabele(): string {
        return "Politycy";
    }
}

?>