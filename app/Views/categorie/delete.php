<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer une Catégorie</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="h3">Supprimer une Catégorie</h1>
        </div>
        <div class="card-body">
            <a href="../CategorieController.php" class="btn btn-secondary">Retour à la liste des catégories</a>

            <?php if ($categorie): ?>
                <p class="mt-3">Voulez-vous vraiment supprimer la catégorie "<?php echo $categorie->getNom(); ?> <?php echo $categorie->getCoderaccourci(); ?>" ?</p>
                <form action="DeleteCategorieController.php?id=<?php echo $categorie->getId(); ?>" method="post">
                    <button type="submit" class="btn btn-danger">Oui, Supprimer</button>
                </form>
            <?php else: ?>
                <p class="text-danger mt-3">La catégorie n'a pas été trouvée.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
