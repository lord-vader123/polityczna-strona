<?php

require_once 'ElementBazy.php';

class Komitet extends ElementBazy {
    protected ?int $id;
    private string $nazwa_komitetu;
    
    public function __construct(?int $id, ?mysqli $conn) {
        parent::__construct($id, $conn);
        $this->nazwa_komitetu = $nazwa_komitetu;
    }
    
    protected function przypiszDane(array $dane) : void {
        $this->id = $dane['id'];
        $this->nazwa_komitetu = $dane['nazwa_komitetu'];
    }
    
    protected function pobierzTabele() : string {
        return "Komitety";
    }

    // Gettery
    public function getId(): ?int {
        return $this->id;
    }

    public function getNazwaKomitetu(): string {
        return $this->nazwa_komitetu;
    }

    // Settery
    public function setNazwaKomitetu(string $nazwa_komitetu): void {
        $this->nazwa_komitetu = $nazwa_komitetu;
    }
}