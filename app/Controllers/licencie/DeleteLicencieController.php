<?php
class DeleteLicencieController {
    private $licencieDAO;

    public function __construct(LicencieDAO $licencieDAO) {
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
    public function deleteLicencie($licencieId) {
        // Récupérer le licencié à supprimer en utilisant son ID
        $licencie = $this->licencieDAO->getLicencieById($licencieId);

        if (!$licencie) {
            // Le licencié n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "Le licencié n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Supprimer le licencié en appelant la méthode du modèle (LicencieDAO)
            if ($this->licencieDAO->removeLicencie($licencie)) {
                // Rediriger vers la page d'accueil après la suppression
                header('Location:../LicencieController.php');
                exit();
            } else {
                // Gérer les erreurs de suppression du licencié
                $_SESSION['error'][] = "Le licencié est associé a un éducateur.";
            }
        }

        // Inclure la vue pour afficher la confirmation de suppression du licencié
        include('../../Views/licencie/delete.php');
    }
}

require_once("../../../config/database.php");
require_once("../../Models/Connexion.php");
require_once("../../Models/Licencie.php");
require_once("../../DAO/LicencieDAO.php");

$licencieDAO = new LicencieDAO(new Connexion());
$controller = new DeleteLicencieController($licencieDAO);
$controller->index();
$controller->deleteLicencie($_GET['id']);
?>
