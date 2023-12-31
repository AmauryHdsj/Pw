<!-- licencieListe.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Licenciés</title>
</head>
<body>

    <h1>Liste des Licenciés</h1>
    <a href="licencie/AddLicencieController.php">Ajouter un licencié</a>

    <table>
        <thead>
            <tr>
                <th>Numéro de Licence</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Catégorie (Code Raccourci)</th>
                <th>Contact (Nom)</th>
                <th>Contact (Email)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($licencies as $licencie) : ?>
                <tr>
                    <td><?php echo $licencie->getNumeroLicence(); ?></td>
                    <td><?php echo $licencie->getNom(); ?></td>
                    <td><?php echo $licencie->getPrenom(); ?></td>
                    <td><?php echo $licencie->getCategorie()->getCoderaccourci(); ?></td>
                    <td><?php echo $licencie->getContact()->getNom(); ?></td>
                    <td><?php echo $licencie->getContact()->getEmail(); ?></td>
                    <td>
                            <a href="licencie/DeleteLicencieController.php?id=<?php echo $licencie->getId(); ?>">Supprimer</a>
                            <a href="licencie/EditLicencieController.php?id=<?php echo $licencie->getId(); ?>">Modifier</a>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
