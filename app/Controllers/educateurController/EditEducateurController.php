<?php
class EditEducateurController {
    private $educateurDAO;
    private $licencieDAO;

    public function __construct(EducateurDAO $educateurDAO, LicencieDAO $licencieDAO) {
        $this->educateurDAO = $educateurDAO;
        $this->licencieDAO = $licencieDAO;
    }
    private function checkAuthentication() {
        session_start();
    // Vérifier si l'utilisateur est authentifié en tant qu'administrateur
    if (!isset($_SESSION['email'])) {
        // Rediriger vers la page de connexion si non authentifié
        header('Location: ../../index.php');
        exit();
    }
}
    public function index()
    {
        $this->checkAuthentication();
    }

    public function editEducateur($educateurId) {
        // Récupérer l'éducateur à modifier en utilisant son ID
        $educateur = $this->educateurDAO->getEducateurById($educateurId);

        if (!$educateur) {
            // L'éducateur n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "L'éducateur n'a pas été trouvé.";
            return;
        }

        // Récupérer la liste des licenciés pour le menu déroulant
        $licencies = $this->licencieDAO->getLicenciesNonEducateurs();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $email = $_POST['email'];
            $motDePasse = $_POST['mot_de_passe'];
            $estAdministrateur = $_POST['est_administrateur'] == 1 ? true : false;
            $licencieId = $_POST['licencie'];

            // Valider les données du formulaire (ajoutez des validations si nécessaire)

            // Mettre à jour les détails de l'éducateur
            $educateur->setEmail($email);
            $educateur->setMotDePasse($motDePasse);
            $educateur->setEstAdministrateur($estAdministrateur);

            // Récupérer l'objet Licencie
            $licencie = $this->licencieDAO->getLicencieById($licencieId);

            // Définir l'objet Licencie dans l'éducateur
            $educateur->setLicencie($licencie);

            // Appeler la méthode du modèle (EducateurDAO) pour mettre à jour l'éducateur
            if ($this->educateurDAO->updateEducateur($educateur)) {
                // Rediriger vers la page de détails de l'éducateur après la modification
                header('Location:../EducateurController.php');
                exit();
            } else {
                // Gérer les erreurs de mise à jour de l'éducateur
                echo "Erreur lors de la modification de l'éducateur.";
            }
        }

        // Inclure la vue pour afficher le formulaire de modification de l'éducateur avec le menu déroulant
        include('../../Views/educateur/edit.php');
    }
}

require_once("../../../config/database.php");
require_once("../../Models/Connexion.php");
require_once("../../Models/Educateur.php");
require_once("../../DAO/EducateurDAO.php");
require_once("../../Models/Licencie.php");
require_once("../../DAO/LicencieDAO.php");

$educateurDAO = new EducateurDAO(new Connexion());
$licencieDAO = new LicencieDAO(new Connexion());

$controller = new EditEducateurController($educateurDAO, $licencieDAO);
$controller->index();
$controller->editEducateur($_GET['id']);
?>
