<?php
include('../../Models/Categorie.php');
class AddCategorieController
{

    private $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO)
    {
        $this->categorieDAO = $categorieDAO;
    }

    // Fonction pour ajouter une nouvelle catégorie
    public function addCategorie()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $coderaccourci = $_POST['coderaccourci'];

            // Valider les données du formulaire (ajoutez des validations si nécessaire)

            // Créer un nouvel objet ContactModel avec les données du formulaire
            $nouvellecategorie = new Categorie(null, $nom, $coderaccourci);

            // Appeler la méthode du modèle (ContactDAO) pour ajouter le contact
            if ($this->categorieDAO->createCategorie($nouvellecategorie)) {
                // Rediriger vers la page d'accueil après l'ajout
                header('Location: ../../Views/categorie/HomeCategorie.php');
                exit();
            } else {
                // Gérer les erreurs d'ajout de contact
                echo "Erreur lors de l'ajout du contact.";
            }
        }

    }
}





