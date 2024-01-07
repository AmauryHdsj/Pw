<?php

use DAO\ContactDAO;

class ContactController {
    private $contactDAO;

    public function __construct(ContactDAO $contactDAO) {
        $this->contactDAO = $contactDAO;
    }

    public function index() {
        // RÃ©cupÃ©rer la liste de tous les contacts depuis le modÃ¨le
        $contacts = $this->contactDAO->listContacts();

        // Inclure la vue pour afficher la liste des contacts
        include('../views/contact/contactListe.php');
    }
}

require_once("../../config/database.php");
require_once("../Models/Connexion.php");
require_once("../Models/Contact.php");
require_once("../DAO/ContactDAO.php");
$contactDAO=new ContactDAO(new Connexion());
$controller=new ContactController($contactDAO);
$controller->index();

?>
