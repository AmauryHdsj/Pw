<?php

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
    public function exportCSV() {
        $this->licencieDAO->exportLicenciesToCSV();
    }

    public function importCSV() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csvFile'])) {
            $csvFile = $_FILES['csvFile']['tmp_name'];

            // Appeler la fonction d'importation
            $success = $this->licencieDAO->importLicenciesFromCSV($csvFile);

            if ($success) {
                echo "Importation réussie !";
            } else {
                echo "Échec de l'importation.";
            }
        } else {
            // Gérer le cas où le formulaire n'est pas soumis correctement
            echo "Formulaire non soumis correctement.";
        }
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
if ( isset($_GET['action']) && $_GET['action'] === 'exportCSV') {
    $controller->exportCSV();
}
if ( isset($_GET['action']) && $_GET['action'] === 'importCSV') {
    $controller->importCSV();
}
$controller->index();
// Dans le contrôleur LicencieController

// Dans LicencieController.php




