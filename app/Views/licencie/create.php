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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
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
                            <h1 class="h4 text-gray-900 mb-4">Formulaire de Création de Licencié</h1>
                        </div>
                        <form class="user" action="AddLicencieController.php" method="POST">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input class="form-control form-control-user" type="text" id="prenom" name="prenom"
                                           required placeholder="Prenom"><br>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-user" type="text" id="nom" name="nom" required
                                           placeholder="Nom"><br>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input class="form-control form-control-user" type="text" id="numero_licence"
                                           name="numero_licence" readonly required placeholder="Numéro du licencié">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="contact_id">Contact:</label>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <select name="contact_id" class="form-control" required>
                                        <?php foreach ($contacts as $contact): ?>
                                            <option value="<?= $contact->getId(); ?>"><?= $contact->getEmail(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <br>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="categorie_id">Catégorie:</label>
                                </div>
                                <div class="col-sm-6">
                                    <select name="categorie_id" id="categorie_id" class="form-control" required>
                                        <?php foreach ($categories as $categorie): ?>
                                            <option value="<?= $categorie->getId(); ?>"><?= $categorie->getCodeRaccourci(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <br>
                                </div>
                            </div>
                            <input class="btn btn-primary btn-user btn-block" type="submit" name="action"
                                   value="Ajouter">
                            <hr>
                            <a class="btn btn-google btn-user btn-block" href="../LicencieController.php">Retour à la
                                liste des Licenciés</a>
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

<!-- Custom script for updating license number in real-time -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var form = document.querySelector(".user");
        var prenomInput = document.getElementById("prenom");
        var nomInput = document.getElementById("nom");
        var numeroLicenceInput = document.getElementById("numero_licence");
        var categorieInput = document.getElementById("categorie_id");

        // Ajoutez un écouteur d'événements sur le champ de saisie du prénom
        prenomInput.addEventListener("input", function () {
            updateNumeroLicence();
        });

        // Ajoutez un écouteur d'événements sur le champ de saisie du nom
        nomInput.addEventListener("input", function () {
            updateNumeroLicence();
        });

        // Ajoutez un écouteur d'événements sur le champ de catégorie
        categorieInput.addEventListener("change", function () {
            updateNumeroLicence();
        });

        // Fonction pour mettre à jour le champ numero_licence
        function updateNumeroLicence() {
            var prenom = prenomInput.value;
            var nom = nomInput.value;
            var categorieCode = categorieInput.options[categorieInput.selectedIndex].text;

            var numeroAleatoire = Math.floor(Math.random() * (999 - 100 + 1)) + 100;

            var numeroLicence = prenom.charAt(0).toUpperCase() + nom + categorieCode + numeroAleatoire;
            numeroLicenceInput.value = numeroLicence;
        }
    });
</script>
</body>

</html>
