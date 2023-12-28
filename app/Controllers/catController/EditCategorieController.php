<?php
class EditCategorieController {
    private $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }

    public function editCategorie($categorieId) {
        // Récupérer le contact à modifier en utilisant son ID
        $categorie = $this->categorieDAO->getById($categorieId);

        if (!$categorie) {
            // Le contact n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "Le contact n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $coderaccourci = $_POST['coderaccourci'];
            // Valider les données du formulaire (ajoutez des validations si nécessaire)

            // Mettre à jour les détails du contact
            $categorie->setNom($nom);
            $categorie->setCoderaccourci($coderaccourci);

            // Appeler la méthode du modèle (ContactDAO) pour mettre à jour le contact
            if ($this->categorieDAO->setCategorie($categorie)) {
                // Rediriger vers la page de détails du contact après la modification
                header('Location:../CategorieController.php');
                exit();
            } else {
                // Gérer les erreurs de mise à jour du contact
                echo "Erreur lors de la modification du contact.";
            }
        }

        // Inclure la vue pour afficher le formulaire de modification du contact
        include('../../Views/categorie/edit.php');
    }
}

require_once("../../../config/database.php");
require_once("../../Models/Connexion.php");
require_once("../../Models/Categorie.php");
require_once("../../DAO/CategorieDAO.php");
$categorieDAO=new CategorieDAO(new Connexion());
$controller=new EditCategorieController($categorieDAO);
$controller->editCategorie($_GET['id']);
?>

