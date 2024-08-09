<?php 

require_once 'ElementBazy.php';

class Polityk extends ElementBazy{
    // parametry
    private string $imie, $nazwisko, $sciezka_do_obrazu;
    private ?int $id_partii, $id_komitetu;
    private bool $jest_poslem;
    protected ?int $id;

    public function __construct(?int $id = NULL, ?mysqli $conn) {
        if ($id !== NULL && $conn !== NULL) {
            parent::__construct($id, $conn);
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

    // Gettery
    public function getImie(): string {
        return $this->imie;
    }

    public function getNazwisko(): string {
        return $this->nazwisko;
    }

    public function getSciezkaDoObrazu(): string {
        return $this->sciezka_do_obrazu;
    }

    public function getIdPartii(): ?int {
        return $this->id_partii;
    }

    public function getIdKomitetu(): ?int {
        return $this->id_komitetu;
    }

    public function getJestPoslem(): bool {
        return $this->jest_poslem;
    }

    public function getId(): ?int {
        return $this->id;
    }

    // Settery
    public function setImie(string $imie): void {
        $this->imie = $imie;
    }

    public function setNazwisko(string $nazwisko): void {
        $this->nazwisko = $nazwisko;
    }

    public function setSciezkaDoObrazu(string $sciezka_do_obrazu): void {
        $this->sciezka_do_obrazu = $sciezka_do_obrazu;
    }

    public function setIdPartii(?int $id_partii): void {
        $this->id_partii = $id_partii;
    }

    public function setIdKomitetu(?int $id_komitetu): void {
        $this->id_komitetu = $id_komitetu;
    }

    public function setJestPoslem(bool $jest_poslem): void {
        $this->jest_poslem = $jest_poslem;
    }
}

?>