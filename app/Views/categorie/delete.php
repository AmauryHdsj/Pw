<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un Contact</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
        <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Supprimer un Contact</h1>
    <a href="CategorieController.php">Retour à la liste des contacts</a>

    <?php if ($categorie): ?>
        <p>Voulez-vous vraiment supprimer le contact "<?php echo $categorie->getNom(); ?> <?php echo $categorie->getCoderaccourci(); ?>" ?</p>
        <form action="DeleteCategorieController.php?id=<?php echo $categorie->getId(); ?>" method="post">
            <input type="submit" value="Oui, Supprimer">
        </form>
    <?php else: ?>
        <p>Le contact n'a pas été trouvé.</p>
    <?php endif; ?>

</body>
</html>

