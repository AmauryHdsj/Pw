<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification - Club Sportif</title>
</head>

<body>

<div>
    <h2>Espace Membre</h2>

    <form action="Authentification.php" method="post">
        <div>
            <label for="email">Adresse Email</label>
            <input type="email" id="email" name="email" value="amaury.herbaut@gmail.com">
        </div>

        <div>
            <label for="password">Mot de Passe</label>
            <input type="password" id="password" name="password" value="123">
        </div>

        <button type="submit">Se Connecter</button>
    </form>
</div>

</body>

</html>

<?php

require_once('C:\Users\amaur\Documents\L3-ISTIC\PW\projet-symphony\app\Controllers\Authentification\AuthController.php');
require_once ('C:\Users\amaur\Documents\L3-ISTIC\PW\projet-symphony\app\Models\Educateur.php');
require_once('C:\Users\amaur\Documents\L3-ISTIC\PW\projet-symphony\app\DAO\EducateurDAO.php');
require_once ('C:\Users\amaur\Documents\L3-ISTIC\PW\projet-symphony\app\Models\Connexion.php');
// Créez une instance du contrôleur
$authController = new AuthController();
