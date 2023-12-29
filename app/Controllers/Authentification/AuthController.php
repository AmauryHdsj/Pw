<?php

class AuthController
{
    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérez les valeurs des champs du formulaire
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;

            // Appelez la méthode login du contrôleur
            if ($this->login($email, $password)) {
                // L'authentification a réussi,
                header('Location: http://localhost:63342/Categorie.php/app/Views/Home/HomeView.php?_ijt=9rkql8qbtp0h6tdhd9agnh8jh&_ij_reload=RELOAD_ON_SAVE');
            
            } else {
                // L'authentification a échoué,
                header('Location: http://localhost:63342/Categorie.php/app/Views/Authentification/AuthFailed.php?_ijt=ua4p56l0jofqmptnldmfsuj1uo&_ij_reload=RELOAD_ON_SAVE');
                exit;
            }
        }
    }

    public function login($email, $motDePasse)
    {
        // Vérifie les informations d'authentification
        $educateurDAO = new EducateurDAO();
        $educateur = $educateurDAO->getEducateurByEmail($email);

        if (!empty($educateur["email"]) && $educateur["isAdmin"] == '1' /*&& password_verify($motDePasse, $educateur["mot_de_passe"])*/) {
            // Authentification réussie
            $_SESSION['user'] = $educateur; // Stockez l'utilisateur dans la session
            return true;
        } else {
            // Authentification échouée
            return false;
        }
    }



    // Ajoutez d'autres méthodes d'authentification ou de gestion des sessions au besoin
}
