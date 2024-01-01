<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un Éducateur</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Supprimer un Éducateur</h1>
    <a href="../EducateurController.php">Retour à la liste des éducateurs</a>

    <?php if ($educateur): ?>
        <p>Voulez-vous vraiment supprimer l'éducateur "<?php echo $educateur->getLicencie()->getNom(); ?> <?php echo $educateur->getLicencie()->getPrenom(); ?>" ?</p>
        <form action="DeleteEducateurController.php?id=<?php echo $educateur->getId(); ?>" method="post">
            <input type="submit" value="Oui, Supprimer">
        </form>
    <?php else: ?>
        <p>L'éducateur n'a pas été trouvé.</p>
    <?php endif; ?>

</body>
</html>
