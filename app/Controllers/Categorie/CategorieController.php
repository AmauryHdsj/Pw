<?php


class CategorieController
{
    public function __construct(CategorieDAO $categorieDAO){
        $this->categorieDAO=$categorieDAO;
    }
    public function index(){
        $tableau=$this->categorieDAO->listCategories();
        return $tableau;
    }


}
