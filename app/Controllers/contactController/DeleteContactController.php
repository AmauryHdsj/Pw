<?php
class DeleteContactController {
    private $contactDAO;

    public function __construct(ContactDAO $contactDAO) {
        $this->contactDAO = $contactDAO;
    }

    public function deleteContact($contactId) {
        // Récupérer le contact à supprimer en utilisant son ID
        $contact = $this->contactDAO->getById($contactId);

        if (!$contact) {
            // Le contact n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            $_SESSION['error'][] = "Le contact n'a pas été trouvé.";
            header('Location:../ContactController.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Supprimer le contact en appelant la méthode du modèle (ContactDAO)
            if ($this->contactDAO->removeContact($contactId)) {
                // Rediriger vers la page d'accueil après la suppression

                header('Location:../ContactController.php');
                exit();
            } else {
                // Gérer les erreurs de suppression du contact
                $_SESSION['error'][] = "Le contact est associé a un licencié.";
                include('../../Views/contact/delete.php');
                exit();
            }
        }

        // Inclure la vue pour afficher la confirmation de suppression du contact
        include('../../Views/contact/delete.php');
    }
}

require_once("../../../config/database.php");
require_once("../../Models/Connexion.php");
require_once("../../Models/Contact.php");
require_once("../../DAO/ContactDAO.php");
$contactDAO=new ContactDAO(new Connexion());
$controller=new DeleteContactController($contactDAO);
$controller->deleteContact($_GET['id']);


?>

