<?php

use DAO\LicencieDAO;

class LicencieController {
    private $licencieDAO;

    public function __construct(LicencieDAO $licencieDAO) {
        $this->licencieDAO = $licencieDAO;
    }

    public function index() {
        // Récupérer la liste de tous les licenciés depuis le modèle
        $licencies = $this->licencieDAO->listLicencies();

        // Inclure la vue pour afficher la liste des licenciés
        include('../views/licencie/licencieListe.php');
    }
}

require_once("../../config/database.php");
require_once("../Models/Connexion.php");
require_once("../Models/Contact.php"); // Assurez-vous que la classe Contact est incluse si utilisée dans la classe Licencie
require_once("../Models/Categorie.php"); // Assurez-vous que la classe Categorie est incluse si utilisée dans la classe Licencie
require_once("../Models/Licencie.php");
require_once("../DAO/ContactDAO.php");
require_once("../DAO/CategorieDAO.php");
require_once("../DAO/LicencieDAO.php");
$licencieDAO = new LicencieDAO(new Connexion());
$controller = new LicencieController($licencieDAO);
$controller->index();

?>
