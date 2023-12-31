<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de Licencié</title>
</head>
<body>

<h2>Formulaire de Création de Licencié</h2>
<a href="../LicencieController.php">Retour à la liste des licenciés</a>


<form action="AddLicencieController.php" method="POST">
    <label for="numero_licence">Numéro de Licence:</label>
    <input type="text" name="numero_licence" required>
    <br>

    <label for="nom">Nom:</label>
    <input type="text" name="nom" required>
    <br>

    <label for="prenom">Prénom:</label>
    <input type="text" name="prenom" required>
    <br>

    <label for="contact_id">Contact:</label>
    <select name="contact_id" required>
        <?php foreach ($contacts as $contact): ?>
            <option value="<?= $contact->getId(); ?>"><?= $contact->getEmail(); ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <label for="categorie_id">Catégorie:</label>
    <select name="categorie_id" required>
        <?php foreach ($categories as $categorie): ?>
            <option value="<?= $categorie->getId(); ?>"><?= $categorie->getCodeRaccourci(); ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <input type="submit"  name="action" value="Ajouter Licencié">
</form>

</body>
</html>
