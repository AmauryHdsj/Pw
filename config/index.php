<?php
/**
// Inclure le fichier de configuration
require_once('../app/DAO/ContactDAO.php');
require_once('../app/DAO/EducateurDAO.php');
require_once('../app/DAO/CategorieDAO.php');
require_once('../app/DAO/LicencieDAO.php');
require_once('../app/Models/Connexion.php');
require_once("config/config.php");

$contactDAO = new ContactDAO();

// Exemple de routage basique
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home'; // Page par défaut
}

// Définir les contrôleurs disponibles
$controllers = [
    'home' => 'HomeController',
    'add' => 'AddContactController',
    'delete' => 'DeleteContactController',
    'edit' => 'EditContactController',
    'login' =>'AuthController'
    // Ajoutez d'autres contrôleurs au besoin
];

// Vérifier si le contrôleur demandé existe
if (array_key_exists($page, $controllers)) {
    $controllerName = $controllers[$page];
    // Inclure le fichier du contrôleur
    require_once('/mon_projet/controllers/' . $controllerName . '.php');
    // Instancier le contrôleur
    $controller = new $controllerName($contactDAO);
    // Exécuter la méthode par défaut du contrôleur (par exemple, index() ou home())
    $controller->index(); // Vous pouvez ajuster la méthode par défaut selon votre convention
} else {
    // Page non trouvée, vous redirigerez vers une page d'erreur 404
    echo "Page non trouvédvsere";
}
?>

*/