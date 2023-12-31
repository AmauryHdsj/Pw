<?php

class ContactDAO {
    private $connexion;

    public function __construct() {
        $this->connexion = new connexion();
    }

    public function createContact(Contact $contact) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO contacts (nom, prenom, email, numero_tel) VALUES (?, ?, ?, ?)");
        $stmt->execute([$contact->getNom(), $contact->getPrenom(), $contact->getEmail(), $contact->getNumero()]);
        return true;
        } catch (PDOException $e) {
            die("Erreur de la fonction createContact=" . $e->getMessage());
        }
    }
    public function getById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM contacts WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Contact($row['id'],$row['nom'], $row['prenom'], $row['email'], $row['numero_tel']);
            } else {
                return null; // Aucun contact trouvÃ© avec cet ID
            }
        } catch (PDOException $e) {
            // GÃ©rer les erreurs de rÃ©cupÃ©ration ici
            return null;
        }
    }

    public function setContact(Contact $contact) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE contacts SET nom = ?, prenom = ?, email = ?, numero_tel = ? WHERE id = ?");
            $stmt->execute([$contact->getNom(), $contact->getPrenom(), $contact->getEmail(), $contact->getNumero(), $contact->getId()]);
            return true;
        } catch (PDOException $e) {
            // GÃ©rer les erreurs de mise Ã  jour ici
            return false;
        }
    }

    public function removeContact($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM contacts WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            // GÃ©rer les erreurs de suppression ici
            return false;
        }
    }
    

    public function listContacts() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM contacts");
            $contacts = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contacts[] = new Contact($row['id'],$row['nom'], $row['prenom'], $row['email'], $row['numero_tel']);
            }

            return $contacts;
        } catch (PDOException $e) {
            // GÃ©rer les erreurs de rÃ©cupÃ©ration ici
            return [];
        }
    
    }
}
