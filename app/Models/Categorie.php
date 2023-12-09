<?php
class Categorie{
    private $nom;
    private $coderaccourci;
    private $id;

    public function __construct($nom,$coderaccourci,$id){
        $this->nom=$nom;
        $this->coderaccourci=$coderaccourci;
        $this->id=$id;

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
