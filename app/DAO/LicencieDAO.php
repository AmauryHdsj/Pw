<?php



class LicencieDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function createLicencie(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO licencies (numero_licence, nom, prenom, contact_id, categorie_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$licencie->getNumeroLicence(), $licencie->getNom(), $licencie->getPrenom(), $licencie->getContact()->getId(), $licencie->getCategorie()->getId()]);

            $licencie->setId($this->connexion->pdo->lastInsertId());
            return true;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return false;
        }
    }

    public function setLicencie(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE licencies SET numero_licence=?, nom=?, prenom=?, contact_id=?, categorie_id=? WHERE id=?");
            $stmt->execute([$licencie->getNumeroLicence(), $licencie->getNom(), $licencie->getPrenom(), $licencie->getContact()->getId(), $licencie->getCategorie()->getId(), $licencie->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return false;
        }
    }

    public function removeLicencie(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM licencies WHERE id = ?");
            $stmt->execute([$licencie->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return false;
        }
    }

    public function listLicencies() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM licencies");
            $licencies = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contactDAO = new ContactDAO($this->connexion);
                $categorieDAO = new CategorieDAO($this->connexion);

                $contact = $contactDAO->getById($row['contact_id']);
                $categorie = $categorieDAO->getById($row['categorie_id']);

                $licencie = new Licencie(
                    $row['id'],
                    $row['numero_licence'],
                    $row['nom'],
                    $row['prenom'],
                    $contact,
                    $categorie
                );

                $licencies[] = $licencie;
            }

            return $licencies;
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return [];
        }
    }

    public function getLicencieById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM licencies WHERE id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $contactDAO = new ContactDAO($this->connexion);
                $categorieDAO = new CategorieDAO($this->connexion);

                $contact = $contactDAO->getById($result['contact_id']);
                $categorie = $categorieDAO->getById($result['categorie_id']);

                $licencie = new Licencie(
                    $result['id'],
                    $result['numero_licence'],
                    $result['nom'],
                    $result['prenom'],
                    $contact,
                    $categorie
                );

                return $licencie;
            }

            return null;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return null;
        }
    }


    public function exportLicenciesToCSV() {
        // Nom du fichier CSV de sortie
        $csvFileName = 'licencies_export.csv';

        // Ouvrir le fichier en écriture
        $csvFile = fopen($csvFileName, 'w');

        // Écrire l'en-tête CSV
        fputcsv($csvFile, ['ID', 'Numero Licence', 'Nom', 'Prenom', 'Contact ID', 'Categorie ID']);

        // Récupérer la liste des licenciés
        $licencies = $this->listLicencies();

        // Écrire les données des licenciés dans le fichier CSV
        foreach ($licencies as $licencie) {
            $contact = $licencie->getContact();
            $categorie = $licencie->getCategorie();

            $data = [
                $licencie->getId(),
                $licencie->getNumeroLicence(),
                $licencie->getNom(),
                $licencie->getPrenom(),
                $contact->getId(),
                $categorie->getId()
            ];

            // Écrire la ligne dans le fichier CSV
            fputcsv($csvFile, $data);
        }

        // Fermer le fichier CSV
        fclose($csvFile);

        // Téléchargement du fichier CSV
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $csvFileName . '"');
        readfile($csvFileName);

        // Supprimer le fichier CSV après le téléchargement
        unlink($csvFileName);

        exit; // Terminer le script après l'exportation pour éviter la sortie HTML supplémentaire
    }



    public function importLicenciesFromCSV($csvFile) {
        // Ouverture du fichier CSV en lecture
        $csvHandle = fopen($csvFile, 'r');

        if ($csvHandle !== false) {
            // Ignorer l'en-tête CSV
            fgetcsv($csvHandle);

            // Boucle pour lire chaque ligne du fichier CSV
            while (($data = fgetcsv($csvHandle)) !== false) {
                // Récupérer les données de la ligne CSV
                $id = $data[0];
                $numeroLicence = $data[1];
                $nom = $data[2];
                $prenom = $data[3];
                $contactId = $data[4];
                $categorieId = $data[5];

                // Créer un nouvel objet Licencie avec les données du CSV
                $licencie = new Licencie($id, $numeroLicence, $nom, $prenom,$contactId,$categorieId);

                // Appeler la méthode du modèle (LicencieDAO) pour ajouter le licencié
                $this->createLicencieCSV($licencie);
            }

            // Fermer le fichier CSV
            fclose($csvHandle);

            return true;
        }

        return false;
    }
    public function createLicencieCSV(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO licencies (numero_licence, nom, prenom, contact_id, categorie_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$licencie->getNumeroLicence(), $licencie->getNom(), $licencie->getPrenom(), $licencie->getContact(), $licencie->getCategorie()]);

            $licencie->setId($this->connexion->pdo->lastInsertId());
            return true;
        } catch (PDOException $e) {
            // Gérer l'erreur
            return false;
        }
    }

}

require_once(__DIR__ . "/../Models/Contact.php");
require_once(__DIR__ . "/ContactDAO.php");
require_once(__DIR__ . "/../Models/Categorie.php");
require_once(__DIR__ . "/CategorieDAO.php");
