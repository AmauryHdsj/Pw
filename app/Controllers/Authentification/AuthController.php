<?php

class AuthController
{
    private $educateurDAO;

    public function __construct(EducateurDAO $educateurDAO)
    {
        $this->educateurDAO = $educateurDAO;
    }

    public function login($email, $motDePasse)
    {
        // Vérifier les informations d'authentification
        $educateur = $this->educateurDAO->getEducateurByEmail($email);

        if ($educateur && password_verify($motDePasse, $educateur->getMotDePasse())) {
            // Authentification réussie
            $_SESSION['user'] = $educateur; // Stockez l'utilisateur dans la session
            return true;
        } else {
            // Authentification échouée
            // Déconnectez l'utilisateur en détruisant la session
            session_destroy();
            header('Location: /'); // Redirigez l'utilisateur vers la page d'accueil par exemple
            return false;
        }
    }


    public function isAdmin()
    {
        // Vérifiez si l'utilisateur est un administrateur
        if (isset($_SESSION['user']) && $_SESSION['user']->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }

    // Ajoutez d'autres méthodes d'authentification ou de gestion des sessions au besoin
}
