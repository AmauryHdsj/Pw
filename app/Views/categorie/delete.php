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
<div id="alert-container" class="position-fixed w-25" style="top: 10px; right: 10px; z-index: 1000;">
    <?php
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        $errorType = ($_SESSION['error'][0] === "L'email existe deja!") ? 'success' : 'danger';
        echo '<div class="alert alert-' . $errorType . ' alert-dismissible fade show" role="alert">';
        echo $_SESSION['error'][0];
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span>';
        echo '</button>';
        echo '</div>';
        unset($_SESSION['error']); // Effacer la variable de session après l'avoir utilisée
    }
    ?>
</div>

<script>
    $(document).ready(function () {
        $('.alert').on('closed.bs.alert', function () {
            location.reload(true);
        });
    });
</script>
</html>
