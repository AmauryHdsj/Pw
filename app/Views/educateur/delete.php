<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un Éducateur</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="h3">Supprimer un Éducateur</h1>
        </div>
        <div class="card-body">
            <a href="../EducateurController.php" class="btn btn-secondary">Retour à la liste des éducateurs</a>

            <?php if ($educateur): ?>
                <p class="mt-3">Voulez-vous vraiment supprimer l'éducateur "<?php echo $educateur->getLicencie()->getNom(); ?> <?php echo $educateur->getLicencie()->getPrenom(); ?>" ?</p>
                <form action="DeleteEducateurController.php?id=<?php echo $educateur->getId(); ?>" method="post">
                    <button type="submit" class="btn btn-danger">Oui, Supprimer</button>
                </form>
            <?php else: ?>
                <p class="text-danger mt-3">L'éducateur n'a pas été trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
