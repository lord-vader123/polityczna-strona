<?php

require_once 'ElementBazy.php';

class Partia extends ElementBazy {

    protected ?int $id;
    private ?string $nazwa_partii, $skrot_nazwy,  $sciezka_do_obrazu;
    
    public function __construct(?int $id = NULL, ?mysqli $conn = NULL ) {
        if ($id !== NULL && $conn !== NULL) {
            parent::__construct($id, $conn);
        }     
    }
        
    protected function przypiszDane(array $dane) : void {
        $this->id = $dane['id_partii'];
        $this->nazwa_partii = $dane['nazwa_partii'];
        $this->skrot_nazwy = $dane['skrot_nazwy'];
        $this->sciezka_do_obrazu = $dane['sciezka_do_obrazu'];
    }
    
    protected function pobierzTabele() : string {
        return "Partie";
    }

    // Gettery
    public function getId(): ?int {
        return $this->id;
    }

    public function getNazwaPartii(): ?string {
        return $this->nazwa_partii;
    }

    public function getSkrotNazwy(): ?string {
        return $this->skrot_nazwy;
    }

    public function getSciezkaDoObrazu(): ?string {
        return $this->sciezka_do_obrazu;
    }

    // Settery
    public function setNazwaPartii(?string $nazwa_partii): void {
        $this->nazwa_partii = $nazwa_partii;
    }

    public function setSkrotNazwy(?string $skrot_nazwy): void {
        $this->skrot_nazwy = $skrot_nazwy;
    }

    public function setSciezkaDoObrazu(?string $sciezka_do_obrazu): void {
        $this->sciezka_do_obrazu = $sciezka_do_obrazu;
    }

}

?>