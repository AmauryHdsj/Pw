<?php

class AddEducateurController
{
    private $educateurDAO;
    private $licencieDAO;

    public function __construct(EducateurDAO $educateurDAO, LicencieDAO $licencieDAO)
    {
        $this->educateurDAO = $educateurDAO;
        $this->licencieDAO = $licencieDAO;
    }

    public function index()
    {
        // Récupérer la liste des licenciés
        $licencies = $this->licencieDAO->getLicenciesNonEducateurs();

        // Inclure la vue pour afficher le formulaire d'ajout d'éducateur
        include('../../Views/educateur/create.php');
    }

    // Fonction pour ajouter un nouvel éducateur
    public function addEducateur()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $email = $_POST['email'];
            $motDePasse = $_POST['mot_de_passe'];
            $estAdministrateur = isset($_POST['est_administrateur']) && $_POST['est_administrateur'] == '1';

            $licencieId = $_POST['licencie_id'];

            // Valider les données du formulaire (ajoutez des validations si nécessaire)

            // Récupérer l'objet Licencie associé à l'ID
            $licencie = $this->licencieDAO->getLicencieById($licencieId);

            if (strlen($motDePasse) < 8) {
            $_SESSION['error'][] = "Le mot de passe doit contenir au moins 8 caractères";
            } else {
                if ($this->educateurDAO->getEducateurByEmail($email)) {
                    $_SESSION['error'][] = "L'email existe déjà";
                }
            }
            // Créer un nouvel objet Educateur avec les données du formulaire et le licencié associé
            $nouvelEducateur = new Educateur(0, $email, $motDePasse, $estAdministrateur, $licencie);

            // Appeler la méthode du modèle (EducateurDAO) pour ajouter l'éducateur
            if ($this->educateurDAO->createEducateur($nouvelEducateur)) {
                // Ajouter un message de succès si nécessaire
                $_SESSION['success'][] = "L'éducateur a été ajouté avec succès";

                // Rediriger vers la page d'accueil après l'ajout
                header('Location:../EducateurController.php');
                exit();
            } else {
                // Gérer les erreurs d'ajout d'éducateur
                $_SESSION['error'][] = "L'éducateur n'a pas pu être ajouté";
            }
        }

        // Récupérer la liste des licenciés
        $licencies = $this->licencieDAO->getLicenciesNonEducateurs();

        // Inclure la vue pour afficher le formulaire d'ajout d'éducateur
        include('../../Views/educateur/create.php');
    }
}

// Initialiser les DAO et le contrôleur
require_once("../../../config/database.php");
require_once("../../Models/Connexion.php");
require_once("../../Models/Educateur.php");
require_once("../../DAO/EducateurDAO.php");
require_once("../../Models/Licencie.php");
require_once("../../DAO/LicencieDAO.php");

$educateurDAO = new EducateurDAO(new Connexion());
$licencieDAO = new LicencieDAO(new Connexion());

$controller = new AddEducateurController($educateurDAO, $licencieDAO);

// Gérer les actions du formulaire
if (!isset($_POST['action'])) {
    $controller->index();
} else {
    $controller->addEducateur();
}
?>
