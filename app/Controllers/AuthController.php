<?php

class AuthController {
    private $educateurDAO;

    public function __construct(EducateurDAO $educateurDAO) {
        $this->educateurDAO = $educateurDAO;
    }

    public function login() {
        // Si l'utilisateur est déjà connecté, redirigez-le vers la page d'accueil des éducateurs
        session_start();
        if (isset($_SESSION['email'])) {
            // header('Location:EducateurController.php');
            exit();
        }

        // Gérer les erreurs de connexion
        $error = isset($_GET['error']) ? true : false;

        // Inclure la vue pour afficher le formulaire de connexion
        include('../Views/Authentification/login.php');
    }

    public function processLogin() {
        // Si l'utilisateur est déjà connecté, redirigez-le vers la page d'accueil des éducateurs
        if (isset($_SESSION['email'])) {
            header('Location: EducateurController.php');
            exit();
        }

        // Gérer les données du formulaire de connexion
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $motDePasse = $_POST['mot_de_passe'];
            session_start();

            try {
                $educateur = $this->educateurDAO->getEducateurByEmail($email);

                // Vérifier si l'éducateur existe et si le mot de passe correspond
                if ($educateur && password_verify($motDePasse, $educateur->getMotDePasse()) && $educateur->getEstAdministrateur()) {
                    // Authentification réussie, enregistrez les informations de l'éducateur dans la session
                    $_SESSION['id'] = $educateur->getId();
                    $_SESSION['email'] = $educateur->getEmail();
                    $_SESSION['prenom'] = $educateur->getLicencie()->getPrenom();
                    // Rediriger vers la page d'accueil des éducateurs
                    header('Location: EducateurController.php');
                    exit();
                } else {
                    // Authentification échouée ou non-administrateur, rediriger vers le formulaire de connexion avec un message d'erreur
                    header('Location: ../Views/Authentification/login.php?error=1');
                    exit();
                }
            } catch (Exception $e) {
                // Loguer ou afficher l'erreur
                echo $e->getMessage();
                // Gérer l'erreur de manière appropriée, par exemple, rediriger avec un message d'erreur
                header('Location: ../Views/Authentification/login.php?error=1');
                exit();
            }
        }
    }


    public function logout() {
        // Déconnexion : détruire la session et rediriger vers la page de connexion
        session_start();
        session_destroy();
        header('Location: ../Views/Authentification/login.php');
        exit();
    }
}

require_once("../../config/database.php");
require_once("../Models/Connexion.php");
require_once("../DAO/EducateurDAO.php");

$educateurDAO = new EducateurDAO(new Connexion());
$controller = new AuthController($educateurDAO);

// Gérer les actions du formulaire
if (!isset($_POST['action'])) {
    header('Location:index.php');
} else {
    $controller->processLogin();
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
$controller->logout();
}