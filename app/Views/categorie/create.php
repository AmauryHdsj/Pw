<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une catégorie</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<h1>Ajouter une catégorie</h1>
<a href="HomeCategorie.php">Retour à la liste des Catégories</a>

<form action="" method="POST">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br>

    <label for="coderaccourci">Code :</label>
    <input type="text" id="coderaccourci" name="coderaccourci" required><br>

    <input type="submit" name="action" value="Ajouter">
</form>

<?php
// Inclure ici la logique pour traiter le formulaire d'ajout de catégorie

include('../../Controllers/Categorie/catController/AddCategorieController.php');
include('../../DAO/CategorieDAO.php');
include('../../Controllers/Categorie/CategorieController.php');
include('../../Models/Connexion.php');

$categorieDAO = new CategorieDAO();
$addCategorie = new AddCategorieController($categorieDAO);
$addCategorie->addCategorie();
?>
</body>
</html>
