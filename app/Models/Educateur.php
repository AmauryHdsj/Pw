<?php
// app/Models/Licencie.php

class Licencie
{
    private $id;
    private $numeroLicence;
    private $nom;
    private $prenom;
    private $contact; // Contient un objet de type Contact


}

// app/Models/Educateur.php

class Educateur extends Licencie
{
    private $email;
    private $motDePasse;
    // attribut permettant de distinguer les Educateurs admin ou non
    private $isAdmin;

// Constructeur, getters et setters spécifiques à Educateur

    public function __construct($numeroLicence, $nom, $prenom, $contact, $email, $motDePasse, $isAdmin)
    {
        parent::__construct($numeroLicence, $nom, $prenom, $contact);
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->isAdmin = $isAdmin;
    }

// Méthodes spécifiques à Educateur

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * @param mixed $motDePasse
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }
}
