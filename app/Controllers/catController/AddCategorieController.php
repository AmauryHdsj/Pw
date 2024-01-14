<?php
class AddCategorieController
{
    private $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
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

    public function index() {
        // Inclure la vue pour afficher le formulaire d'ajout de contact
        $this->checkAuthentication();
        include('../../Views/categorie/create.php');
        }
        // Fonction pour ajouter une nouvelle catégorie
        public function addCategorie() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupérer les données du formulaire
                $nom = $_POST['nom'];
                $coderaccourci = $_POST['coderaccourci'];
    
                // Valider les données du formulaire (ajoutez des validations si nécessaire)
    
                // Créer un nouvel objet ContactModel avec les données du formulaire
                $nouvellecategorie = new Categorie(0, $nom,  $coderaccourci);
    
                // Appeler la méthode du modèle (ContactDAO) pour ajouter le contact
                if ($this->categorieDAO->createCategorie($nouvellecategorie)) {
                    // Rediriger vers la page d'accueil après l'ajout
                    header('Location:../CategorieController.php');
                exit();
                } else {
                    // Gérer les erreurs d'ajout de contact
                    echo "Erreur lors de l'ajout du contact.";
                }
            }
    
            // Inclure la vue pour afficher le formulaire d'ajout de contact
            include('../../Views/categorie/create.php');
        }
}

require_once("../../../config/database.php");
require_once("../../Models/Connexion.php");
require_once("../../Models/Categorie.php");
require_once("../../DAO/CategorieDAO.php");
$categorieDAO=new CategorieDAO(new Connexion());
$controller=new AddCategorieController($categorieDAO);

if(!isset($_POST['action'])){
    $controller->index();
}else{
    $controller->addCategorie();
}



