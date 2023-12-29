<?php

class LicencieDAO {
    private $connexion;

    public function __construct() {
        $this->connexion = new connexion();
    }

    public function createLicencie(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO licencie(numero_licence, nom, prenom, contact_id, categorie_id) VALUES (:numero_licence, :nom, :prenom, :contact_id, :categorie_id)");
            $stmt->bindValue(":numero_licence", $licencie->getNumeroLicence(), PDO::PARAM_STR);
            $stmt->bindValue(":nom", $licencie->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":prenom", $licencie->getPrenom(), PDO::PARAM_STR);
            $stmt->bindValue(":contact_id", $licencie->getContactId(), PDO::PARAM_INT);
            $stmt->bindValue(":categorie_id", $licencie->getCategorieId(), PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die("Erreur de la fonction createLicencie=" . $e->getMessage());
        }
    }

    public function setLicencie(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE licencie SET numero_licence=:numero_licence, nom=:nom, prenom=:prenom, contact_id=:contact_id, categorie_id=:categorie_id WHERE id=:id");
            $stmt->bindValue(":numero_licence", $licencie->getNumeroLicence(), PDO::PARAM_STR);
            $stmt->bindValue(":nom", $licencie->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":prenom", $licencie->getPrenom(), PDO::PARAM_STR);
            $stmt->bindValue(":contact_id", $licencie->getContactId(), PDO::PARAM_INT);
            $stmt->bindValue(":categorie_id", $licencie->getCategorieId(), PDO::PARAM_INT);
            $stmt->bindValue(":id", $licencie->getId(), PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur de la fonction setLicencie=" . $e->getMessage());
        }
    }

    public function removeLicencie(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM licencie WHERE id = :id");
            $stmt->bindValue(":id", $licencie->getId(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur de la fonction removeLicencie=" . $e->getMessage());
        }
    }

    public function listLicencies() {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM licencie");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de la fonction listLicencies=" . $e->getMessage());
        }
    }
}
