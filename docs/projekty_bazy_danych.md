# Cel

Celem tej bazy danych jest przechowywanie informacji na temat polityków, posłów, partii i komitetów wyborczych.
Zapewnia ona szybki dostęp do informacji, które przechowuje.
Przechowuje wszelkie powiązania pomiędzy politykami a ich partiami i komitetami. 
Dodatkowo zapisuje ona konta użytkowników strony.

# Normalizacja

## 1 stopień normalizacji / dane atomowe

- Imie_użytkownika
- Nazwisko_użytkownika
- Login_użytkownika
- Hasło_użytkownika
 
- Imie_polityka
- Nazwisko_polityka
- Jest_posłem
- Portret

- Nazwa_partii
- Skrót_nazwy
- Logo_partii

- Nazwa_komitetu

## 2 stopień normalizacji

### Tabela Użytkownicy
| Kolumna           | Typ danych       | Opis                   |
|-------------------|------------------|------------------------|
| id_użytkownika    | INT (PK)         | Unikalne ID użytkownika|
| imie_użytkownika  | VARCHAR(255)     | Imię użytkownika       |
| nazwisko_użytkownika | VARCHAR(255) | Nazwisko użytkownika   |
| login_użytkownika | VARCHAR(255)     | Login użytkownika      |
| hasło_użytkownika | VARCHAR(255)     | Hasło użytkownika      |

### Tabela Politycy
| Kolumna           | Typ danych       | Opis                   |
|-------------------|------------------|------------------------|
| id_polityka       | INT (PK)         | Unikalne ID polityka   |
| imie_polityka     | VARCHAR(255)     | Imię polityka          |
| nazwisko_polityka | VARCHAR(255)     | Nazwisko polityka      |
| jest_posłem       | BOOLEAN          | Czy polityk jest posłem|
| portret           | VARCHAR(255)     | Ścieżka do folderu     |

### Tabela Partie
| Kolumna           | Typ danych       | Opis                   |
|-------------------|------------------|------------------------|
| id_partii         | INT (PK)         | Unikalne ID partii     |
| nazwa_partii      | VARCHAR(255)     | Pełna nazwa partii     |
| skrot_nazwy       | VARCHAR(50)      | Skrót nazwy partii     |
| logo_partii       | VARCHAR(255)     | Logo partii            |

### Tabela Komitety
| Kolumna           | Typ danych       | Opis                   |
|-------------------|------------------|------------------------|
| id_komitetu       | INT (PK)         | Unikalne ID komitetu   |
| nazwa_komitetu    | VARCHAR(255)     | Nazwa komitetu         |
| skrot_komitetu    | VARCHAR(255)     | Skrót nazwy komitetu   |

## 3 stopień normalizacji

### Tabela Użytkownicy
| Kolumna           | Typ danych       | Opis                   |
|-------------------|------------------|------------------------|
| id_użytkownika    | INT (PK)         | Unikalne ID użytkownika|
| imie_użytkownika  | VARCHAR(255)     | Imię użytkownika       |
| nazwisko_użytkownika | VARCHAR(255) | Nazwisko użytkownika   |
| login_użytkownika | VARCHAR(255)     | Login użytkownika      |
| hasło_użytkownika | VARCHAR(255)     | Hasło użytkownika      |

### Tabela Politycy
| Kolumna           | Typ danych       | Opis                   |
|-------------------|------------------|------------------------|
| id_polityka       | INT (PK)         | Unikalne ID polityka   |
| imie_polityka     | VARCHAR(255)     | Imię polityka          |
| nazwisko_polityka | VARCHAR(255)     | Nazwisko polityka      |
| jest_posłem       | BOOLEAN          | Czy polityk jest posłem|
| portret           | VARCHAR(255)     | Ścieżka do folderu     |

### Tabela Partie
| Kolumna           | Typ danych       | Opis                   |
|-------------------|------------------|------------------------|
| id_partii         | INT (PK)         | Unikalne ID partii     |
| nazwa_partii      | VARCHAR(255)     | Pełna nazwa partii     |
| skrot_nazwy       | VARCHAR(50)      | Skrót nazwy partii     |
| logo_partii       | VARCHAR(255)     | Logo partii            |

### Tabela Komitety
| Kolumna           | Typ danych       | Opis                   |
|-------------------|------------------|------------------------|
| id_komitetu       | INT (PK)         | Unikalne ID komitetu   |
| nazwa_komitetu    | VARCHAR(255)     | Nazwa komitetu         |

### Tabela Przynależność_Partyjna
| Kolumna           | Typ danych       | Opis                   |
|-------------------|------------------|------------------------|
| id_przynależności | INT (PK)         | Unikalne ID przynależności |
| id_polityka       | INT (FK)         | ID polityka            |
| id_partii         | INT (FK)         | ID partii              |

### Tabela Przynależność_Komitetowa
| Kolumna           | Typ danych       | Opis                   |
|-------------------|------------------|------------------------|
| id_przynależności | INT (PK)         | Unikalne ID przynależności |
| id_polityka       | INT (FK)         | ID polityka            |
| id_komitetu       | INT (FK)         | ID komitetu            |

# Relacje między tabelami
- **Politycy** mają relację z **Partiami** przez tabelę **Przynależność_Partyjna**
- **Politycy** mają relację z **Komitetami** przez tabelę **Przynależność_Komitetowa**
