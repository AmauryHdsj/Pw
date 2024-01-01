<!-- educateurListe.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Éducateurs</title>
</head>
<body>

    <h1>Liste des Éducateurs</h1>
    <a href="educateurController/AddEducateurController.php">Ajouter un éducateur</a>

    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Est Administrateur</th>
                <th>Licencié (Numéro de Licence)</th>
                <th>Licencié (Nom)</th>
                <th>Licencié (Prénom)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($educateurs as $educateur) : ?>
                <tr>
                    <td><?php echo $educateur->getEmail(); ?></td>
                    <td><?php echo $educateur->getEstAdministrateur() ? 'Oui' : 'Non'; ?></td>
                    <td><?php echo $educateur->getLicencie()->getNumeroLicence(); ?></td>
                    <td><?php echo $educateur->getLicencie()->getNom(); ?></td>
                    <td><?php echo $educateur->getLicencie()->getPrenom(); ?></td>
                    <td>
                        <a href="educateurController/DeleteEducateurController.php?id=<?php echo $educateur->getId(); ?>">Supprimer</a>
                        <a href="educateurController/EditEducateurController.php?id=<?php echo $educateur->getId(); ?>">Modifier</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
