<?php

class CategorieDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function createCategorie(Categorie $categorie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO categories (nom, code_raccourci) VALUES (:nom, :code_raccourci)");
            $stmt->bindValue(":nom", $categorie->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":code_raccourci", $categorie->getCoderaccourci(), PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur de la fonction createCategorie : " . $e->getMessage());
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM categories WHERE id = :id");
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Categorie($row['id'], $row['nom'], $row['code_raccourci']);
            } else {
                return null; // Aucune catégorie trouvée avec cet ID
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return null;
        }
    }

    public function setCategorie(Categorie $categorie) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE categories SET nom = :nom, code_raccourci = :code_raccourci WHERE id = :id");
            $stmt->bindValue(":nom", $categorie->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":code_raccourci", $categorie->getCoderaccourci(), PDO::PARAM_STR);
            $stmt->bindValue(":id", $categorie->getId(), PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de mise à jour ici
            echo "Erreur de mise à jour : " . $e->getMessage();
            return false;
        }
    }

    public function removeCategorie($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM categories WHERE id = :id");
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de suppression ici
            return false;
        }
    }

    public function listCategories() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM categories");
            $categories = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = new Categorie($row['id'], $row['nom'], $row['code_raccourci']);
            }

            return $categories;
        } catch (PDOException $e) {
            return [];
        }
    }
}
