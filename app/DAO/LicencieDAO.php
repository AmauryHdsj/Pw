<?php

class LicencieDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function createLicencie(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO licencies (numero_licence, nom, prenom, contact_id, categorie_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$licencie->getNumeroLicence(), $licencie->getNom(), $licencie->getPrenom(), $licencie->getContact()->getId(), $licencie->getCategorie()->getId()]);

            $licencie->setId($this->connexion->pdo->lastInsertId());
            return true;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return false;
        }
    }

    public function setLicencie(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE licencies SET numero_licence=?, nom=?, prenom=?, contact_id=?, categorie_id=? WHERE id=?");
            $stmt->execute([$licencie->getNumeroLicence(), $licencie->getNom(), $licencie->getPrenom(), $licencie->getContact()->getId(), $licencie->getCategorie()->getId(), $licencie->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return false;
        }
    }

    public function removeLicencie(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM licencies WHERE id = ?");
            $stmt->execute([$licencie->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return false;
        }
    }

    public function listLicencies() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM licencies");
            $licencies = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contactDAO = new ContactDAO($this->connexion);
                $categorieDAO = new CategorieDAO($this->connexion);

                $contact = $contactDAO->getById($row['contact_id']);
                $categorie = $categorieDAO->getById($row['categorie_id']);

                $licencie = new Licencie(
                    $row['id'],
                    $row['numero_licence'],
                    $row['nom'],
                    $row['prenom'],
                    $contact,
                    $categorie
                );

                //$licencie->setId($row['id']);
                $licencies[] = $licencie;
            }

            return $licencies;
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return [];
        }
    }

    public function getLicencieById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM licencies WHERE id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $contactDAO = new ContactDAO($this->connexion);
                $categorieDAO = new CategorieDAO($this->connexion);

                $contact = $contactDAO->getById($result['contact_id']);
                $categorie = $categorieDAO->getById($result['categorie_id']);

                $licencie = new Licencie(
                    $result['id'],
                    $result['numero_licence'],
                    $result['nom'],
                    $result['prenom'],
                    $contact,
                    $categorie
                );

                //$licencie->setId($result['id']);
                return $licencie;
            }

            return null;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return null;
        }
    }
}

require_once(__DIR__ . "/../Models/Contact.php");
require_once(__DIR__ . "/ContactDAO.php");
require_once(__DIR__ . "/../Models/Categorie.php");
require_once(__DIR__ . "/CategorieDAO.php");
