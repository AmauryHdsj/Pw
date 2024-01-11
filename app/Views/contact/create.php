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
                                <h1 class="h4 text-gray-900 mb-4">Ajouter un Contact</h1>
                            </div>
                                <form class="user" action="AddContactController.php" method="POST">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="text" id="nom" name="nom" required placeholder="Nom"><br>
                                        </div>
                                        <div class="col-sm-6">
                                        <input class="form-control form-control-user" type="text" id="prenom" name="prenom" required placeholder="Prenom"><br>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="email" id="email" name="email" required placeholder="Email"><br>
                                        </div>
                                        <div class="col-sm-6">
                                        <input class="form-control form-control-user" type="text" id="numero" name="numero" required placeholder="Numéro de telephonne"><br>
                                        </div>
                                    </div>
                                
                                    <input  class="btn btn-primary btn-user btn-block" type="submit" name="action" value="Ajouter">
                                    <hr>
                                    <a class="btn btn-google btn-user btn-block" href="../ContactController.php">Retour à la liste des Contacts</a>

                                </form>

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


    <?php
    // Inclure ici la logique pour traiter le formulaire d'ajout de contact
    ?>
    </form>

    <?php
    // Inclure ici la logique pour traiter le formulaire d'ajout de contact
    ?>

</body>
</html>

