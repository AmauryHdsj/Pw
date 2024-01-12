<?php

namespace App\Entity;

use App\Repository\LicenciesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LicenciesRepository::class)]
class Licencies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $numero_licence = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\ManyToOne(inversedBy: 'licencie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contacts $contact = null;

    #[ORM\ManyToOne(inversedBy: 'licencie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $categorie = null;

    #[ORM\OneToOne(mappedBy: 'licencie', cascade: ['persist', 'remove'])]
    private ?Educateurs $educateurs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroLicence(): ?string
    {
        return $this->numero_licence;
    }

    public function setNumeroLicence(string $numero_licence): static
    {
        $this->numero_licence = $numero_licence;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getContact(): ?Contacts
    {
        return $this->contact;
    }

    public function setContact(?Contacts $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getEducateurs(): ?Educateurs
    {
        return $this->educateurs;
    }

    public function setEducateurs(Educateurs $educateurs): static
    {
        // set the owning side of the relation if necessary
        if ($educateurs->getLicencie() !== $this) {
            $educateurs->setLicencie($this);
        }

        $this->educateurs = $educateurs;

        return $this;
    }
}
