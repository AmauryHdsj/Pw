<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../../public/vendor//fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="EducateurController.php" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <span>Educateurs</span>
            </a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="LicencieController.php" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <span>Licencié</span>
            </a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="CategorieController.php" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <span>Catégorie</span>
            </a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="ContactController.php" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <span>Contact</span>
            </a>
        </li>

    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo isset($_SESSION['prenom']) ? $_SESSION['prenom'] : 'error'; ?></span></span>
                            <img class="img-profile rounded-circle" src="../../public/img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Liste des Licenciés</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><a
                                    href="catController/AddCategorieController.php">Ajouter un licencié</a></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Numéro de Licence</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Catégorie (Code Raccourci)</th>
                                    <th>Contact (Nom)</th>
                                    <th>Contact (Email)</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php

                                foreach ($licencies as $licencie) : ?>
                                    <tr>
                                        <td><?php echo $licencie->getNumeroLicence(); ?></td>
                                        <td><?php echo $licencie->getNom(); ?></td>
                                        <td><?php echo $licencie->getPrenom(); ?></td>
                                        <td><?php echo $licencie->getCategorie()->getCoderaccourci(); ?></td>
                                        <td><?php echo $licencie->getContact()->getNom(); ?></td>
                                        <td><?php echo $licencie->getContact()->getEmail(); ?></td>
                                        <td>
                                            <a href="licencie/DeleteLicencieController.php?id=<?php echo $licencie->getId(); ?>">Supprimer</a>
                                            <a href="licencie/EditLicencieController.php?id=<?php echo $licencie->getId(); ?>">Modifier</a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <a href="LicencieController.php?action=exportCSV" class="btn btn-primary">
                                        <i class="fas fa-file-export"></i> Exporter CSV
                                    </a>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <form action="LicencieController.php?action=importCSV" method="post" enctype="multipart/form-data">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="csvFile" name="csvFile" accept=".csv">
                                                <label class="custom-file-label" for="csvFile">Choisissez un fichier CSV à importer</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-file-import"></i> Importer
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="AuthController.php?action=logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../../public/vendor/jquery/jquery.min.js"></script>
<script src="../../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../public/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../../public/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../../public/js/demo/datatables-demo.js"></script>

</body>

</html>
