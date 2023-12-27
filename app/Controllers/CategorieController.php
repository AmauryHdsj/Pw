<?php
class CategorieController {
    private $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }

    public function index() {
        // RÃ©cupÃ©rer la liste de tous les contacts depuis le modÃ¨le
        $categories = $this->categorieDAO->listCategories();

        // Inclure la vue pour afficher la liste des contacts
        include('../views/categorie/categorieliste.php');
    }
}

require_once("../../config/database.php");
require_once("../Models/Connexion.php");
require_once("../Models/Categorie.php");
require_once("../DAO/CategorieDAO.php");

$categorieDAO=new CategorieDAO(new Connexion());
$controller=new CategorieController($categorieDAO);
$controller->index();

?>
