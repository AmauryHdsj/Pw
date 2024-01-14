<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un Contact</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="h3">Supprimer un Contact</h1>
        </div>
        <div class="card-body">
            <a href="../ContactController.php" class="btn btn-secondary">Retour à la liste des contacts</a>

            <?php if ($contact): ?>
                <p class="mt-3">Voulez-vous vraiment supprimer le contact "<?php echo $contact->getNom(); ?> <?php echo $contact->getPrenom(); ?>" ?</p>
                <form action="DeleteContactController.php?id=<?php echo $contact->getId(); ?>" method="post">
                    <button type="submit" class="btn btn-danger">Oui, Supprimer</button>
                </form>
            <?php else: ?>
                <p class="text-danger mt-3">Le contact n'a pas été trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<div id="alert-container" class="position-fixed w-25" style="top: 10px; right: 10px; z-index: 1000;">
    <?php
    if (isset($_SESSION['error'])) {
        $errorType = (!empty($_SESSION['error']) && $_SESSION['error'][0] === "Le contact est associé a un licencié.") ? 'danger' : 'success';

        echo '<div class="alert alert-' . $errorType . ' alert-dismissible fade show" role="alert">';
        echo $_SESSION['error'][0]; //
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span>';
        echo '</button>';
        echo '</div>';
        unset($_SESSION['error']);
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
</body>
</html>
