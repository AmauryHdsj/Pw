<?php

class EducateurDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function createEducateur(Educateur $educateur) {
        try {
            
            // Insérer l'éducateur dans la table educateurs et récupérer l'ID généré
            $stmt = $this->connexion->pdo->prepare("INSERT INTO educateurs (email, mot_de_passe, est_administrateur, licencie_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$educateur->getEmail(), $educateur->getMotDePasse(), $educateur->getEstAdministrateur(), $educateur->getLicencie()->getId()]);

            $educateur->setId($this->connexion->pdo->lastInsertId());
            return true;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return false;
        }
    }

    public function updateEducateur(Educateur $educateur) {
        try {
            // Mettre à jour les informations de l'éducateur dans la table educateurs
            $stmt = $this->connexion->pdo->prepare("UPDATE educateurs SET email=?, mot_de_passe=?, est_administrateur=?, licencie_id=? WHERE id=?");
            $stmt->execute([$educateur->getEmail(), $educateur->getMotDePasse(), $educateur->getEstAdministrateur(), $educateur->getLicencie()->getId(), $educateur->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return false;
        }
    }

    public function deleteEducateur(Educateur $educateur) {
        try {
            // Supprimer l'éducateur de la table educateurs
            $stmt = $this->connexion->pdo->prepare("DELETE FROM educateurs WHERE id = ?");
            $stmt->execute([$educateur->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return false;
        }
    }

    public function listEducateurs() {
        try {
            // Récupérer la liste des éducateurs depuis la table educateurs
            $stmt = $this->connexion->pdo->query("SELECT * FROM educateurs");
            $educateurs = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Pour chaque éducateur, récupérer l'objet Licencie associé
                $licencieDAO = new LicencieDAO($this->connexion);
                $licencie = $licencieDAO->getLicencieById($row['licencie_id']);

                $educateur = new Educateur(
                    $row['id'],
                    $row['email'],
                    $row['mot_de_passe'],
                    $row['est_administrateur'],
                    $licencie
                );

                $educateurs[] = $educateur;
            }

            return $educateurs;
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return [];
        }
    }

    public function getEducateurById($id) {
        try {
            // Récupérer les informations de l'éducateur avec l'ID spécifié
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM educateurs WHERE id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Récupérer l'objet Licencie associé à l'éducateur
                $licencieDAO = new LicencieDAO($this->connexion);
                $licencie = $licencieDAO->getLicencieById($result['licencie_id']);

                $educateur = new Educateur(
                    $result['id'],
                    $result['email'],
                    $result['mot_de_passe'],
                    $result['est_administrateur'],
                    $licencie
                );

                return $educateur;
            }

            return null;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return null;
        }
    }
}

require_once(__DIR__ . "/../Models/Licencie.php");
require_once(__DIR__ . "/LicencieDAO.php");
