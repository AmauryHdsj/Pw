<?php

use DAO\CategorieDAO;
use DAO\ContactDAO;
use DAO\LicencieDAO;

class AddLicencieController
{
    private $licencieDAO;
    private $contactDAO;
    private $categorieDAO;

    public function __construct(LicencieDAO $licencieDAO, ContactDAO $contactDAO, CategorieDAO $categorieDAO) {
        $this->licencieDAO = $licencieDAO;
        $this->contactDAO = $contactDAO;
        $this->categorieDAO = $categorieDAO;
    }

    public function index() {
        // Récupérer la liste des contacts et des catégories
        $contacts = $this->contactDAO->listContacts();
        $categories = $this->categorieDAO->listCategories();

        // Inclure la vue pour afficher le formulaire d'ajout de licencié
        include('../../Views/licencie/create.php');
    }

    // Fonction pour ajouter un nouveau licencié
    public function addLicencie() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $numeroLicence = $_POST['numero_licence'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $contactId = $_POST['contact_id'];
            $categorieId = $_POST['categorie_id'];

            // Valider les données du formulaire (ajoutez des validations si nécessaire)

            // Récupérer l'objet Contact associé à l'ID
            $contact = $this->contactDAO->getById($contactId);

            // Récupérer l'objet Categorie associé à l'ID
            $categorie = $this->categorieDAO->getById($categorieId);

            // Créer un nouvel objet Licencie avec les données du formulaire, le contact et la catégorie associés
            $nouveauLicencie = new Licencie(0, $numeroLicence, $nom, $prenom, $contact, $categorie);

            // Appeler la méthode du modèle (LicencieDAO) pour ajouter le licencié
            if ($this->licencieDAO->createLicencie($nouveauLicencie)) {
                // Rediriger vers la page d'accueil après l'ajout
                header('Location:../LicencieController.php');
                exit();
            } else {
                // Gérer les erreurs d'ajout de licencié
                echo "Erreur lors de l'ajout du licencié.";
            }
        }

        // Récupérer la liste des contacts et des catégories
        $contacts = $this->contactDAO->listContacts();
        $categories = $this->categorieDAO->listCategories();

        // Inclure la vue pour afficher le formulaire d'ajout de licencié
        include('../../Views/licencie/create.php');
    }
}

// Initialiser les DAO et le contrôleur
require_once("../../../config/database.php");
require_once("../../Models/Connexion.php");
require_once("../../Models/Licencie.php");
require_once("../../DAO/LicencieDAO.php");
require_once("../../Models/Contact.php");
require_once("../../DAO/ContactDAO.php");
require_once("../../Models/Categorie.php");
require_once("../../DAO/CategorieDAO.php");

$licencieDAO = new LicencieDAO(new Connexion());
$contactDAO = new ContactDAO(new Connexion());
$categorieDAO = new CategorieDAO(new Connexion());

$controller = new AddLicencieController($licencieDAO, $contactDAO, $categorieDAO);

// Gérer les actions du formulaire
if (!isset($_POST['action'])) {
    $controller->index();
} else {
    $controller->addLicencie();
}
?>
