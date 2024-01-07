<?php

class EducateurDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function createEducateur(Educateur $educateur) {
        try {
            // Générer un sel aléatoire
            $salt = bin2hex(random_bytes(16));

            // Hacher le mot de passe avec le sel
            $hashedPassword = password_hash($educateur->getMotDePasse() . $salt, PASSWORD_BCRYPT);

            // Insérer l'éducateur dans la table educateurs et récupérer l'ID généré
            $stmt = $this->connexion->pdo->prepare("INSERT INTO educateurs (email, mot_de_passe, est_administrateur, licencie_id, salt) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$educateur->getEmail(), $hashedPassword, $educateur->getEstAdministrateur(), $educateur->getLicencie()->getId(), $salt]);

            $educateur->setId($this->connexion->pdo->lastInsertId());
            return true;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return false;
        }
    }


    public function updateEducateur(Educateur $educateur) {
        try {
            // Récupérer le sel associé à l'utilisateur depuis la base de données
            $stmt = $this->connexion->pdo->prepare("SELECT salt FROM educateurs WHERE id = ?");
            $stmt->execute([$educateur->getId()]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $salt = $result['salt'];

                // Hacher le nouveau mot de passe avec le sel existant
                $hashedPassword = password_hash($educateur->getMotDePasse() . $salt, PASSWORD_BCRYPT);

                // Mettre à jour les informations de l'éducateur dans la base de données
                $stmt = $this->connexion->pdo->prepare("UPDATE educateurs SET email=?, mot_de_passe=?, est_administrateur=?, licencie_id=? WHERE id=?");
                $stmt->execute([$educateur->getEmail(), $hashedPassword, $educateur->getEstAdministrateur(), $educateur->getLicencie()->getId(), $educateur->getId()]);

                return true;
            }

            return false; // Gérer le cas où l'utilisateur n'est pas trouvé
        } catch (PDOException $e) {
            // Gérer l'erreur
            return false;
        }
    }


    public function deleteEducateur(Educateur $educateur) {
        try {
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
            $stmt = $this->connexion->pdo->query("SELECT * FROM educateurs");
            $educateurs = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM educateurs WHERE id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
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

    public function getEducateurByEmail($email) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM educateurs WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $licencieDAO = new LicencieDAO($this->connexion);
                $licencie = $licencieDAO->getLicencieById($result['licencie_id']);

                return new Educateur(
                    $result['id'],
                    $result['email'],
                    $result['mot_de_passe'],
                    $result['est_administrateur'],
                    $licencie
                );
            }

            return null;
        } catch (PDOException $e) {
            // Loguer ou afficher l'erreur pour débogage
            echo $e->getMessage();
            // Lancer une exception ou prendre d'autres mesures appropriées
            throw $e;
        }
    }
}
require_once(__DIR__ . "/../Models/Licencie.php");
require_once(__DIR__ . "/LicencieDAO.php");
require_once(__DIR__ . '/../Models/Educateur.php');