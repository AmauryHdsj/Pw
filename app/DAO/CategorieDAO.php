<?php

class CategorieDAO{
    private $connexion;

    public function __construct(Connexion $connexion){
        $this->connexion=$connexion;
    }

    public function createCategorie(Categorie $categorie){
        try{
            $stmt=$this->connexion->pdo->prepare("INSERT INTO categorie(nom,nom_raccourci) VALUES (?, ?)");
            $stmt->execute([$categorie->getNom(), $categorie->getCoderaccourci()]);
            return true;

        } catch (PDOException $e) {
            die("Erreur de la fonction createCategorie=".$e->getMessage());
        }
    }
    public function setCategorie(Categorie $categorie){
        try{
            $stmt=$this->connexion->pdo->prepare("UPDATE categorie SET nom=?,nomraccourci=? WHERE id=?");
            $stmt->execute([$categorie->getId(),$categorie->getNom(),$categorie->getCoderaccourci()]);
        }
        catch (PDOException $e) {
            die("Erreur de la fonction setCategorie=".$e->getMessage());
        }
    }
}