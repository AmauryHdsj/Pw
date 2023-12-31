<?php
// app/Models/Licencie.php

class Licencie
{
    private $id;
    private $numeroLicence;
    private $nom;
    private $prenom;
    private $contact; // Objet Contact
    private $categorie; // Objet Categori

// Constructeur
public function __construct($id, $numeroLicence, $nom, $prenom, $contact, $categorie) {
    $this->id = $id;
    $this->numeroLicence = $numeroLicence;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->contact = $contact;
    $this->categorie = $categorie;
}

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNumeroLicence()
    {
        return $this->numeroLicence;
    }

    /**
     * @param mixed $numeroLicence
     */
    public function setNumeroLicence($numeroLicence)
    {
        $this->numeroLicence = $numeroLicence;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }

     /**
     * @return mixed
     */

    public function getCategorie() {
        return $this->categorie;
    }

     /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

}
