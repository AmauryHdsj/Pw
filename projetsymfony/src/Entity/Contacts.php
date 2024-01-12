<?php

namespace App\Entity;

use App\Repository\ContactsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactsRepository::class)]
class Contacts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 15)]
    private ?string $numero_tel = null;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Licencies::class, orphanRemoval: true)]
    private Collection $licencies;

    #[ORM\ManyToMany(targetEntity: MailContact::class, mappedBy: 'destinataire')]
    private Collection $mailcontactreçu;

    public function __construct()
    {
        $this->licencies = new ArrayCollection();
        $this->mailcontactreçu = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNumeroTel(): ?string
    {
        return $this->numero_tel;
    }

    public function setNumeroTel(string $numero_tel): static
    {
        $this->numero_tel = $numero_tel;

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
            $licency->setContact($this);
        }

        return $this;
    }

    public function removeLicency(Licencies $licency): static
    {
        if ($this->licencies->removeElement($licency)) {
            // set the owning side to null (unless already changed)
            if ($licency->getContact() === $this) {
                $licency->setContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MailContact>
     */
    public function getMailcontactreçu(): Collection
    {
        return $this->mailcontactreçu;
    }

    public function addMailcontactreU(MailContact $mailcontactreU): static
    {
        if (!$this->mailcontactreçu->contains($mailcontactreU)) {
            $this->mailcontactreçu->add($mailcontactreU);
            $mailcontactreU->addDestinataire($this);
        }

        return $this;
    }

    public function removeMailcontactreU(MailContact $mailcontactreU): static
    {
        if ($this->mailcontactreçu->removeElement($mailcontactreU)) {
            $mailcontactreU->removeDestinataire($this);
        }

        return $this;
    }
}
