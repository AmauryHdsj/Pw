<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 10)]
    private ?string $code_raccourci = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Licencies::class, orphanRemoval: true)]
    private Collection $licencies;

    public function __construct()
    {
        $this->licencies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCodeRaccourci(): ?string
    {
        return $this->code_raccourci;
    }

    public function setCodeRaccourci(string $code_raccourci): static
    {
        $this->code_raccourci = $code_raccourci;

        return $this;
    }

    /**
     * @return Collection<int, Licencies>
     */
    public function getLicencies(): Collection
    {
        return $this->licencies;
    }

    public function addLicency(Licencies $licency): static
    {
        if (!$this->licencies->contains($licency)) {
            $this->licencies->add($licency);
            $licency->setCategorie($this);
        }

        return $this;
    }

    public function removeLicency(Licencies $licency): static
    {
        if ($this->licencies->removeElement($licency)) {
            // set the owning side to null (unless already changed)
            if ($licency->getCategorie() === $this) {
                $licency->setCategorie(null);
            }
        }

        return $this;
    }
}
