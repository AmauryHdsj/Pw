<?php

class Educateur
{
    private $id;
    private $email;
    private $motDePasse;
    private $estAdministrateur;
    private $licencie; // Objet Licencie

    // Constructeur, getters et setters spécifiques à Educateur

    public function __construct($id, $email, $motDePasse, $estAdministrateur, $licencie)
    {
        $this->id = $id;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->estAdministrateur = $estAdministrateur;
        $this->licencie = $licencie;
    }

    // Méthodes spécifiques à Educateur

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function getEstAdministrateur() {
        return $this->estAdministrateur;
    }

    public function getLicencie() {
        return $this->licencie;
    }

    // Setters

    public function setId($id) {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
    }

    public function setEstAdministrateur($estAdministrateur) {
        $this->estAdministrateur = $estAdministrateur;
    }

    public function setLicencie($licencie) {
        $this->licencie = $licencie;
    }
}


