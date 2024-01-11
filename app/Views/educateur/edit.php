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
                                <h1 class="h4 text-gray-900 mb-4">Modifier un educateurs</h1>
                            </div>
                            <?php if ($educateur): ?>
                                <form class="user" action="EditEducateurController.php?id=<?php echo $educateur->getId(); ?>" method="POST">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="text" id="email" name="email" value="<?php echo $educateur->getEmail(); ?>" required placeholder="Email"><br>
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="password" id="mot_de_passe" name="mot_de_passe" value="<?php echo $educateur->getMotDePasse(); ?>" required placeholder="Mot de passe"><br>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 ">
                                        <label for="est_administrateur">Administrateur :
                                            <input type="radio" id="est_administrateur" name="est_administrateur" value="1" <?php if ($educateur->getEstAdministrateur()) echo "checked"; ?>> Oui
                                            <input type="radio" id="est_administrateur" name="est_administrateur" value="0" <?php if (!$educateur->getEstAdministrateur()) echo "checked"; ?>> Non
                                        </label>
                                        <br>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2 mb-3 mb-sm-0">
                                            <label for="licencie_id">Licencié:</label>
                                        </div>
                                        <div class="col-m6">
                                        <select id="licencie" name="licencie" required>
                                            <?php foreach ($licencies as $licencie): ?>
                                                <option value="<?php echo $licencie->getId(); ?>" <?php if ($licencie->getId() === $educateur->getLicencie()->getId()) echo "selected"; ?>>
                                                    <?php echo $licencie->getNom() . ' ' . $licencie->getPrenom(); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select><br>
                                        </div>

                                    </div>
                                
                                    <input  class="btn btn-primary btn-user btn-block" type="submit" name="action" value="Modifier">
                                    <hr>
                                    <a class="btn btn-google btn-user btn-block" href="../EducateurController.php">Retour à la liste des éducateurs</a>

                                </form>
                                <?php else: ?>
                                <p>L'éducateur n'a pas été trouvé.</p>
                                <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../../public/vendor/jquery/jquery.min.js"></script>
    <script src="../../../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../../public/js/sb-admin-2.min.js"></script>

</body>
</html>
