<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des catégories</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Liste des catégories</h1>
    <a href="catController/AddCategorieController.php">Ajouter une catégorie</a>

    <?php if (count($categories) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>code</th>
                    <th>Prénom</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $categorie): ?>
                    <tr>
                    <td><?php echo $categorie->getCoderaccourci(); ?></td>
                    <td><?php echo $categorie->getNom(); ?></td>
                    <td>
                        <a href="catController/EditCategorieController.php?id=<?php echo $categorie->getId(); ?>">Modifier</a>
                        <a href="catController/DeleteCategorieController.php?id=<?php echo $categorie->getId(); ?>">Supprimer</a>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun contact trouvé.</p>
    <?php endif; ?>
</body>
</html>

