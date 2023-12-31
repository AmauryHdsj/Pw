<!DOCTYPE html>

<?php

include('C:\Users\amaur\Documents\L3-ISTIC\PW\projet-symphony\app\DAO\CategorieDAO.php');
include('C:\Users\amaur\Documents\L3-ISTIC\PW\projet-symphony\app\Controllers\Categorie\CategorieController.php');
include('C:\Users\amaur\Documents\L3-ISTIC\PW\projet-symphony\app\Models\Connexion.php');

$categorieDAO=new CategorieDAO();
$allCategorie =new CategorieController($categorieDAO);
$tableau=$allCategorie->index();

?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Catégories</title>

</head>
<body>
<h1>Liste des Catégories</h1>
<a href="create.php">Ajouter une catégorie</a>

<table>
    <thead>
    <tr>
        <th>Nom</th>
        <th>Code_Raccourci</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($tableau as $category) { ?>
        <tr>
            <td><?php echo $category['nom']; ?></td>
            <td><?php echo $category['code_raccourci']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $category['id']; ?>">Modifier</a>
                <a href="delete.php?id=<?php echo $category['id']; ?>">Supprimer</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php
// Vérifiez si le tableau est vide
if (empty($tableau)) {
    echo "<p>Aucune catégorie trouvée.</p>";
}
?>

</body>
</html>

