<?php
class EditContactController {
    private $contactDAO;

    public function __construct(ContactDAO $contactDAO) {
        $this->contactDAO = $contactDAO;
    }

    public function editContact($contactId) {
        // Récupérer le contact à modifier en utilisant son ID
        $contact = $this->contactDAO->getById($contactId);

        if (!$contact) {
            // Le contact n'a pas été trouvé, vous pouvez rediriger ou afficher un message d'erreur
            echo "Le contact n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $telephone = $_POST['numero'];

            // Valider les données du formulaire (ajoutez des validations si nécessaire)

            // Mettre à jour les détails du contact
            $contact->setNom($nom);
            $contact->setPrenom($prenom);
            $contact->setEmail($email);
            $contact->setNumero($telephone);

            // Appeler la méthode du modèle (ContactDAO) pour mettre à jour le contact
            if ($this->contactDAO->setContact($contact)) {
                // Rediriger vers la page de détails du contact après la modification
                header('Location:../ContactController.php ');
                exit();
            } else {
                // Gérer les erreurs de mise à jour du contact
                echo "Erreur lors de la modification du contact.";
            }
        }

        // Inclure la vue pour afficher le formulaire de modification du contact
        include('../../Views/contact/edit.php');
    }
}

require_once("../../../config/database.php");
require_once("../../Models/Connexion.php");
require_once("../../Models/contact.php");
require_once("../../DAO/ContactDAO.php");
$contactDAO=new ContactDAO(new Connexion());
$controller=new EditContactController($contactDAO);
$controller->editContact($_GET['id']);
?>

