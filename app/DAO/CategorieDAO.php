<?php

class CategorieDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function createCategorie(Categorie $categorie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO categorie(nom, nom_raccourci) VALUES (:nom, :nom_raccourci)");
            $stmt->bindValue(":nom", $categorie->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":nom_raccourci", $categorie->getCoderaccourci(), PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die("Erreur de la fonction createCategorie" . $e->getMessage());
        }
    }

    public function setCategorie(Categorie $categorie) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE categorie SET nom=:nom, nom_raccourci=:nom_raccourci WHERE id=:id");
            $stmt->bindValue(":nom", $categorie->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":nom_raccourci", $categorie->getCoderaccourci(), PDO::PARAM_STR);
            $stmt->bindValue(":id", $categorie->getId(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur de la fonction setCategorie" . $e->getMessage());
        }
    }

    public function removeCategorie(Categorie $categorie) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM categorie WHERE id = :id");
            $stmt->bindValue(":id", $categorie->getId(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur de la fonction removeCategorie" . $e->getMessage());
        }
    }

    public function listCategories() {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM categorie");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de la fonction listCategories" . $e->getMessage());
        }
    }
}
