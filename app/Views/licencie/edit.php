<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Licencié</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Modifier un Licencié</h1>
    <a href="../LicencieController.php">Retour à la liste des licenciés</a>

    <?php if ($licencie): ?>
        <form action="EditLicencieController.php?id=<?php echo $licencie->getId(); ?>" method="post">
            <label for="numeroLicence">Numéro de Licence :</label>
            <input type="text" id="numeroLicence" name="numeroLicence" value="<?php echo $licencie->getNumeroLicence(); ?>" required><br>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $licencie->getNom(); ?>" required><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $licencie->getPrenom(); ?>" required><br>

            <!-- Liste déroulante pour le contact -->
            <label for="contact">Contact :</label>
            <select id="contact" name="contact" required>
                <?php foreach ($contacts as $c): ?>
                    <option value="<?php echo $c->getId(); ?>" <?php if ($c->getId() === $licencie->getContact()->getId()) echo "selected"; ?>>
                        <?php echo $c->getEmail(); ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <!-- Liste déroulante pour la catégorie -->
            <label for="categorie">Catégorie :</label>
            <select id="categorie" name="categorie" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat->getId(); ?>" <?php if ($cat->getId() === $licencie->getCategorie()->getId()) echo "selected"; ?>>
                        <?php echo $cat->getCodeRaccourci(); ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <input type="submit" value="Modifier">
        </form>
    <?php else: ?>
        <p>Le licencié n'a pas été trouvé.</p>
    <?php endif; ?>

</body>
</html>
