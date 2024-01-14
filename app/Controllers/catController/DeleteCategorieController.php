<?php
class DeleteCategorieController {
    private $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }

    public function deleteCategorie($categorieId) {
        // Récupérer le contact à supprimer en utilisant son ID
        $categorie = $this->categorieDAO->getById($categorieId);

        if (!$categorie) {
            // Le contact n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "Le contact n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Supprimer le contact en appelant la méthode du modèle (ContactDAO)
            if ($this->categorieDAO->removeCategorie($categorieId)) {
                // Rediriger vers la page d'accueil après la suppression
                header('Location:../CategorieController.php');
                exit();
            } else {
                // Gérer les erreurs de suppression du contact
                $_SESSION['error'][] = "La catégorie est associé a un licencié.";

            }
        }

        // Inclure la vue pour afficher la confirmation de suppression du contact
        include('../../Views/categorie/delete.php');
    }
}

require_once("../../../config/database.php");
require_once("../../Models/Connexion.php");
require_once("../../Models/Categorie.php");
require_once("../../DAO/CategorieDAO.php");
$categorieDAO=new CategorieDAO(new Connexion());
$controller=new DeleteCategorieController($categorieDAO);
$controller->deleteCategorie($_GET['id']);


?>

