<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="../../../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../../public/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"> </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Formulaire de Création d'Éducateur</h1>
                            </div>
                                <form class="user" action="AddEducateurController.php" method="POST">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="email" name="email" required placeholder="Email"><br>
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="password" name="mot_de_passe" required placeholder="Mot de passe"><br>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 ">
                                        <label  for="est_administrateur">Administrateur :</label>
                                            <input  type="radio" id="est_administrateur_oui" name="est_administrateur" value="1"> 
                                        <label for="est_administrateur_oui">Oui</label>
                                        <input type="radio" id="est_administrateur_nom" name="est_administrateur" value="0">
                                            <label for="est_administrateur_non">Non</label>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2 mb-3 mb-sm-0">
                                            <label for="licencie_id">Licencié:</label>
                                        </div>
                                        <div class="col-m6">
                                        <select name="licencie_id" required class="form-control">
                                                    <?php foreach ($licencies as $licencie): ?>
                                                        <option value="<?= $licencie->getId(); ?>">
                                                            <?= $licencie->getNumeroLicence() . ' - ' . $licencie->getNom() . ' ' . $licencie->getPrenom(); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <br>
                                        </div>

                                    </div>
                                
                                    <input  class="btn btn-primary btn-user btn-block" type="submit" name="action" value="Ajouter">
                                    <hr>
                                    <a class="btn btn-google btn-user btn-block" href="../EducateurController.php">Retour à la liste des éducateurs</a>

                                </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
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


    <!-- Bootstrap core JavaScript-->
    <script src="../../../public/vendor/jquery/jquery.min.js"></script>
    <script src="../../../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../../public/js/sb-admin-2.min.js"></script>

</body>
</html>
