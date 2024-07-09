<?php

require_once 'ElementBazy.php';

class Partia extends ElementBazy {

    protected ?int $id;
    private ?string $nazwa_partii, $skrot_nazwy,  $sciezka_do_obrazu;
    
    public function __construct($id = NULL, $conn = NULL, $nazwa_partii, $skrot_nazwy, $sciezka_do_obrazu) {
        if ($id !== NULL && $conn !== NULL) {
            parent::__construct($id, $conn);
        } else {
            $this->nazwa_partii = $nazwa_partii;
            $this->skrot_nazwy = $skrot_nazwy;
            $this->sciezka_do_obrazu = $sciezka_do_obrazu;
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

}

?>