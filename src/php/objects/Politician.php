<?php

include __DIR__ . '/MySqlObject.php';

class Politician extends MySqlObject {
    
    public function __construct(mysqli|null $conn, int|null $id) {
        parent::__construct($conn, $id);

    }

    public function getTable(): string {
        return "Politicians";
    }
    
    public function setData(array $data): bool {
        if (is_array($data) && count($data) == 5) {
            $data = [
                "name" => $data["name"],
                "surname" => $data["surname"],
                "party_affillation" => $data["party_affillation"],
                "committee_membership" => $data["committee_membership"],
                "portrait" => $data["portrait"],
            ];
            $this->setDataArray($data);
            return true;
        } else {
            throw new Exception('Wrong argument provided');
        }
    }
    
    public function sendToDb(): bool {
        $stmt = $this->conn->prepare('INSERT INTO ' . "politicians" . '(name, surname, party_affiliation, committee_membership, portrait) VALUES (?, ?, ?, ?, ?)');
        if (!$stmt) {
            throw new Exception('Preparing statement failed');
        }
        
        $data = $this->getDataArray();
        
        $stmt->bind_param('ssiis', $data['name'], $data['surname'], $data['party_affillation'], $data['committee_membership'], $data['portrait']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    
    public function createCommitteeMembership(int $committeId) : bool {
        $stmt = $this->conn->prepare('INSERT INTO committee_membership (committee_id, joining_date) VALUES (?, CURDATE())');
        if (!$stmt) {
            throw new Exception('Error preparing statement');
        }
        
        $stmt->bind_param('i', $committeId);
        
        if (!$stmt->execute()) {
            throw new Exception('Something broke while executing query');
        }
        
        $stmt->close();
        return true;
    }

    public function createPartyAffiliation(int $partyId) : bool {
        $stmt = $this->conn->prepare('INSERT INTO party_affiliation (party_id, joining_date) VALUES (?, CURDATE())');
        if (!$stmt) {
            throw new Exception('Error preparing statement');
        }
        
        $stmt->bind_param('i', $committeId);
        
        if (!$stmt->execute()) {
            throw new Exception('Something broke while executing query');
        }
        
        $stmt->close();
        return true;
    }
}