<?php
class Categorie{
    private $nom;
    private $coderaccourci;

    public function __construct($nom,$coderaccourci){
        $this->nom=$nom;
        $this->coderaccourci=$coderaccourci;

    }

    /**
     * @return mixed
     */
    public function getCoderaccourci()
    {
        return $this->coderaccourci;
    }

    /**
     * @param mixed $coderaccourci
     */
    public function setCoderaccourci($coderaccourci)
    {
        $this->coderaccourci = $coderaccourci;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
}
