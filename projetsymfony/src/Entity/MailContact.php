<?php

namespace App\Entity;

use App\Repository\MailContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MailContactRepository::class)]
class MailContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_envoie = null;

    #[ORM\Column(length: 255)]
    private ?string $objet = null;

    #[ORM\Column(length: 300)]
    private ?string $message = null;

    #[ORM\ManyToMany(targetEntity: Contacts::class, inversedBy: 'mailcontactreçu')]
    #[ORM\JoinTable(name: 'mail_contact_edu')]
    private Collection $destinataire;

    #[ORM\ManyToOne(inversedBy: 'mailecontactenvoye')]
    private ?Educateurs $expediteur = null;



    public function __construct()
    {
        $this->destinataire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDenvoie(): ?\DateTimeInterface
    {
        return $this->date_envoie;
    }

    public function setDateDenvoie(\DateTimeInterface $date_envoie): static
    {
        $this->date_envoie = $date_envoie;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): static
    {
        $this->objet = $objet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection<int, Contacts>
     */
    public function getDestinataire(): Collection
    {
        return $this->destinataire;
    }

    public function addDestinataire(Contacts $destinataire): static
    {
        if (!$this->destinataire->contains($destinataire)) {
            $this->destinataire->add($destinataire);
        }

        return $this;
    }

    public function removeDestinataire(Contacts $destinataire): static
    {
        $this->destinataire->removeElement($destinataire);

        return $this;
    }

    public function getExpediteur(): ?Educateurs
    {
        return $this->expediteur;
    }

    public function setExpediteur(?Educateurs $expediteur): static
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    
}
