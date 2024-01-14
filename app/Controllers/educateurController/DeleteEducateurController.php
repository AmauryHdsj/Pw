<?php

class DeleteEducateurController {
    private $educateurDAO;

    public function __construct(EducateurDAO $educateurDAO) {
        $this->educateurDAO = $educateurDAO;
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
    public function deleteEducateur($educateurId) {
        // Récupérer l'éducateur à supprimer en utilisant son ID
        $educateur = $this->educateurDAO->getEducateurById($educateurId);

        if (!$educateur) {
            // L'éducateur n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "L'éducateur n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Supprimer l'éducateur en appelant la méthode du modèle (EducateurDAO)
            if ($this->educateurDAO->deleteEducateur($educateur)) {
                // Rediriger vers la page d'accueil après la suppression
                header('Location:../EducateurController.php');
                exit();
            } else {
                // Gérer les erreurs de suppression de l'éducateur
                echo "Erreur lors de la suppression de l'éducateur.";
            }
        }

        // Inclure la vue pour afficher la confirmation de suppression de l'éducateur
        include('../../Views/educateur/delete.php');
    }
}

require_once("../../../config/database.php");
require_once("../../Models/Connexion.php");
require_once("../../Models/Educateur.php");
require_once("../../DAO/EducateurDAO.php");

$educateurDAO = new EducateurDAO(new Connexion());
$controller = new DeleteEducateurController($educateurDAO);
$controller->index();
$controller->deleteEducateur($_GET['id']);
