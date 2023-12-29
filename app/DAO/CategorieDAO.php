<?php

class CategorieDAO {
    private $connexion;

    public function __construct() {
        $this->connexion = new connexion();
    }

    public function createCategorie(Categorie $categorie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO categorie(nom, code_raccourci) VALUES (:nom, :code_raccourci)");
            $stmt->bindValue(":nom", $categorie->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":code_raccourci", $categorie->getCoderaccourci(), PDO::PARAM_STR);
           // $stmt->execute([$categorie->getNom(), $categorie->getCoderaccourci()]);
           $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur de la fonction createCategorie" . $e->getMessage());
        }
    }

        // MÃ©thode pour rÃ©cupÃ©rer un contact par son ID
    public function getById($id) {
        try{
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM categorie WHERE categorie.id=$id");
            $this->connexion->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt->execute();
            //recupere les resultats de la requete
            $resultat=$stmt->fetch(PDO::FETCH_ASSOC);
            return $resultat;
        }catch(PDOException $e){
            die("Erreur de la fonction getContact : ".$e->getMessage());
        }

    }

    public function setCategorie(Categorie $categorie) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE categories SET nom = ?, code_raccourci = ? WHERE id = ?");
            $stmt->execute([$categorie->getNom(), $categorie->getCoderaccourci(), $categorie->getId()]);
            return true;
        } catch (PDOException $e) {
            // GÃ©rer les erreurs de mise Ã  jour ici
            echo "Erreur de mise à jour : " . $e->getMessage();
            return false;
        }
    }

    

    public function removeCategorie($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM categories WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            // GÃ©rer les erreurs de suppression ici
            return false;
        }
    }

    public function listCategories() {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM categorie");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de la fonction listEducateurs=" . $e->getMessage());
        }
    }

}
