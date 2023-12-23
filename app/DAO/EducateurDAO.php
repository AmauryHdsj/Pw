<?php

class EducateurDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function createEducateur(Educateur $educateur) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO educateur(email, mot_de_passe, nom, prenom, isAdmin) VALUES (:email, :mot_de_passe, :nom, :prenom, :isAdmin)");
            $stmt->bindValue(":email", $educateur->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":mot_de_passe", $educateur->getMotDePasse(), PDO::PARAM_STR);
            $stmt->bindValue(":nom", $educateur->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":prenom", $educateur->getPrenom(), PDO::PARAM_STR);
            $stmt->bindValue(":isAdmin", $educateur->isAdmin(), PDO::PARAM_INT);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die("Erreur de la fonction createEducateur=" . $e->getMessage());
        }
    }

    public function setEducateur(Educateur $educateur) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE educateur SET email=:email, mot_de_passe=:mot_de_passe, nom=:nom, prenom=:prenom, isAdmin=:isAdmin WHERE id=:id");
            $stmt->bindValue(":email", $educateur->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":mot_de_passe", $educateur->getMotDePasse(), PDO::PARAM_STR);
            $stmt->bindValue(":nom", $educateur->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":prenom", $educateur->getPrenom(), PDO::PARAM_STR);
            $stmt->bindValue(":isAdmin", $educateur->isAdmin(), PDO::PARAM_INT);
            $stmt->bindValue(":id", $educateur->getId(), PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur de la fonction setEducateur=" . $e->getMessage());
        }
    }

    public function removeEducateur(Educateur $educateur) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM educateur WHERE id = :id");
            $stmt->bindValue(":id", $educateur->getId(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur de la fonction removeEducateur=" . $e->getMessage());
        }
    }

    public function listEducateurs() {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM educateur");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de la fonction listEducateurs=" . $e->getMessage());
        }
    }
}
