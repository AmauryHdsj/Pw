
<?php

// Supposons que ce fichier PHP est dans le répertoire Controllers
// et que les autres fichiers sont dans des répertoires adjacents


include('../../Controllers/Categorie/catController/EditCategorieController.php');
include('../../DAO/CategorieDAO.php');
include('../../Controllers/Categorie/CategorieController.php');
include('../../Models/Connexion.php');

// Récupérer l'ID depuis la requête
$id = $_GET['id'];

// Créer une instance de CategorieDAO
$categorieDAO = new CategorieDAO();

// Récupérer la catégorie par ID
$categorie = $categorieDAO->getById($id);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Catégorie</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
        <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Modifier un Contact</h1>
    <a href="HomeCategorie.php">Retour à la liste des Catégories</a>

    <?php if ($categorie): ?>
        <form action="EditCategorieController.php?id=<?php echo $categorie['id']; ?>" method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $categorie['nom']; ?>" required><br>

            <label for="coderaccourci">Code :</label>
            <input type="text" id="coderaccourci" name="coderaccourci" value="<?php echo $categorie['code_raccourci']; ?>" required><br>

            <input type="submit" value="Modifier">
        </form>
    <?php else: ?>
        <p>Le contact n'a pas été trouvé.</p>
    <?php endif; ?>

</body>
</html>

