<?php

namespace App\Entity;

use App\Repository\EducateursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: EducateursRepository::class)]
class Educateurs implements UserInterface, PasswordAuthenticatedUserInterface{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_de_passe = null;

    #[ORM\Column]
    private ?bool $est_administrateur = null;
    #[ORM\OneToOne(inversedBy: 'educateurs', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Licencies $licencie = null;

    #[ORM\OneToMany(mappedBy: 'expediteur', targetEntity: MailContact::class)]
    private Collection $mailecontactenvoye;

    #[ORM\ManyToMany(targetEntity: MailEdu::class, mappedBy: 'destinataire')]
    private Collection $mailedureçu;

    #[ORM\OneToMany(mappedBy: 'expediteur', targetEntity: MailEdu::class)]
    private Collection $maileduenvoye;

    public function __construct()
    {
        $this->mailecontactenvoye = new ArrayCollection();
        $this->mailedureçu = new ArrayCollection();
        $this->maileduenvoye = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMotDePasse(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe): static
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    public function isEstAdministrateur(): ?bool
    {
        return $this->est_administrateur;
    }

    public function setEstAdministrateur(bool $est_administrateur): static
    {
        $this->est_administrateur = $est_administrateur;

        return $this;
    }

    public function getLicencie(): ?Licencies
    {
        return $this->licencie;
    }

    public function setLicencie(Licencies $licencie): static
    {
        $this->licencie = $licencie;

        return $this;
    }

    /**
     * @return Collection<int, MailContact>
     */
    public function getMailecontactenvoye(): Collection
    {
        return $this->mailecontactenvoye;
    }

    public function addMailecontactenvoye(MailContact $mailecontactenvoye): static
    {
        if (!$this->mailecontactenvoye->contains($mailecontactenvoye)) {
            $this->mailecontactenvoye->add($mailecontactenvoye);
            $mailecontactenvoye->setExpediteur($this);
        }

        return $this;
    }

    public function removeMailecontactenvoye(MailContact $mailecontactenvoye): static
    {
        if ($this->mailecontactenvoye->removeElement($mailecontactenvoye)) {
            // set the owning side to null (unless already changed)
            if ($mailecontactenvoye->getExpediteur() === $this) {
                $mailecontactenvoye->setExpediteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MailEdu>
     */
    public function getMailedureçu(): Collection
    {
        return $this->mailedureçu;
    }

    public function addMailedureU(MailEdu $mailedureU): static
    {
        if (!$this->mailedureçu->contains($mailedureU)) {
            $this->mailedureçu->add($mailedureU);
            $mailedureU->addDestinataire($this);
        }

        return $this;
    }

    public function removeMailedureU(MailEdu $mailedureU): static
    {
        if ($this->mailedureçu->removeElement($mailedureU)) {
            $mailedureU->removeDestinataire($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, MailEdu>
     */
    public function getMaileduenvoye(): Collection
    {
        return $this->maileduenvoye;
    }

    public function addMaileduenvoye(MailEdu $maileduenvoye): static
    {
        if (!$this->maileduenvoye->contains($maileduenvoye)) {
            $this->maileduenvoye->add($maileduenvoye);
            $maileduenvoye->setExpediteur($this);
        }

        return $this;
    }

    public function removeMaileduenvoye(MailEdu $maileduenvoye): static
    {
        if ($this->maileduenvoye->removeElement($maileduenvoye)) {
            // set the owning side to null (unless already changed)
            if ($maileduenvoye->getExpediteur() === $this) {
                $maileduenvoye->setExpediteur(null);
            }
        }

        return $this;
    }

    public function getPassword(): ?string
{
    // TODO: Implement getPassword() method.
    return $this->mot_de_passe;
}

public function getRoles(): array
{
    $admin =$this->est_administrateur;
    // TODO: Implement getRoles() method.
    if ($admin==1){
        $roles[]='ROLE_ADMIN';
    }
    $roles[]='ROLE_USER';
    return array_unique($roles);

}

public function eraseCredentials(): void
{
    // TODO: Implement eraseCredentials() method.
}

public function getUserIdentifier(): string
{
    return (string) $this->email;
    // TODO: Implement getUserIdentifier() method.
}
}
