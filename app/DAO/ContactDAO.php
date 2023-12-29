<?php

class ContactDAO {
    private $connexion;

    public function __construct() {
        $this->connexion = new connexion();
    }

    public function createContact(Contact $contact) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO contact(nom, prenom, email, numero_tel) VALUES (:nom, :prenom, :email, :numero_tel)");
            $stmt->bindValue(":nom", $contact->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":prenom", $contact->getPrenom(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $contact->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":numero_tel", $contact->getNumeroTel(), PDO::PARAM_STR);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die("Erreur de la fonction createContact=" . $e->getMessage());
        }
    }

    public function setContact(Contact $contact) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE contact SET nom=:nom, prenom=:prenom, email=:email, numero_tel=:numero_tel WHERE id=:id");
            $stmt->bindValue(":nom", $contact->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":prenom", $contact->getPrenom(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $contact->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":numero_tel", $contact->getNumeroTel(), PDO::PARAM_STR);
            $stmt->bindValue(":id", $contact->getId(), PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur de la fonction setContact=" . $e->getMessage());
        }
    }

    public function removeContact(Contact $contact) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM contact WHERE id = :id");
            $stmt->bindValue(":id", $contact->getId(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur de la fonction removeContact=" . $e->getMessage());
        }
    }

    public function listContacts() {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM contact");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de la fonction listContacts=" . $e->getMessage());
        }
    }
}
