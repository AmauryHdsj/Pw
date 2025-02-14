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
                                <h1 class="h4 text-gray-900 mb-4">Modifier un Licencié</h1>
                            </div>
                            <?php if ($licencie): ?>
                                <form class="user" action="EditLicencieController.php?id=<?php echo $licencie->getId(); ?>" method="POST">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="text" id="numeroLicence" name="numeroLicence" value="<?php echo $licencie->getNumeroLicence(); ?>" required ><br>
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="text" id="nom" name="nom" value="<?php echo $licencie->getNom(); ?>" required><br>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="text" id="prenom" name="prenom" value="<?php echo $licencie->getPrenom(); ?>" required><br>
                                    
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="contact_id">Contact:</label>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select id="contact" name="contact" required>
                                            <?php foreach ($contacts as $c): ?>
                                                <option value="<?php echo $c->getId(); ?>" <?php if ($c->getId() === $licencie->getContact()->getId()) echo "selected"; ?>>
                                                    <?php echo $c->getEmail(); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select><br>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                         <label for="categorie_id">Catégorie:</label>
                                        </div>
                                        <div class="col-sm-6">
                                        <select id="categorie" name="categorie" required>
                                            <?php foreach ($categories as $cat): ?>
                                                <option value="<?php echo $cat->getId(); ?>" <?php if ($cat->getId() === $licencie->getCategorie()->getId()) echo "selected"; ?>>
                                                    <?php echo $cat->getCodeRaccourci(); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select><br>
                                        </div>
                                    </div>
                                
                                    <input  class="btn btn-primary btn-user btn-block" type="submit" name="action" value="Modifier">
                                    <hr>
                                    <a class="btn btn-google btn-user btn-block" href="../LicencieController.php">Retour à la liste des Licenciés</a>

                                </form>
                                <?php else: ?>
                                    <p>Le licencié n'a pas été trouvé.</p>
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
