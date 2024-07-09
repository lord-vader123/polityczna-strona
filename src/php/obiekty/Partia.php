<?php

class Partia extends ElementBazy {

    private ?int $id;
    private ?string $nazwa_partii, $skrot_nazwy,  $sciezka_do_obrazu;
    
    public function __construct($id = NULL, $conn = NULL, $nazwa_partii, $skrot_nazwy, $sciezka_do_obrazu) {
        if ($id !== NULL && $conn !== NULL) {
            parent::__construct($id, $conn);
        }
        
        
        
    }


}

?>