<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilepicture = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Facture::class)]
    private Collection $Factures;

    #[ORM\OneToMany(mappedBy: 'seller', targetEntity: Fichier::class)]
    private Collection $Fichiers;

    public function __construct()
    {
        $this->Factures = new ArrayCollection();
        $this->Fichiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getProfilepicture(): ?string
    {
        return $this->profilepicture;
    }

    public function setProfilepicture(string $profilepicture): self
    {
        $this->profilepicture = $profilepicture;

        return $this;
    }

    /**
     * @return Collection<int, Facture>
     */
    public function getFactures(): Collection
    {
        return $this->Factures;
    }

    public function addFacture(Facture $Facture): self
    {
        if (!$this->Factures->contains($Facture)) {
            $this->Factures->add($Facture);
            $Facture->setCustomer($this);
        }

        return $this;
    }

    public function removeFacture(Facture $Facture): self
    {
        if ($this->Factures->removeElement($Facture)) {
            // set the owning side to null (unless already changed)
            if ($Facture->getCustomer() === $this) {
                $Facture->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fichier>
     */
    public function getFichiers(): Collection
    {
        return $this->Fichiers;
    }

    public function addFichier(Fichier $Fichier): self
    {
        if (!$this->Fichiers->contains($Fichier)) {
            $this->Fichiers->add($Fichier);
            $Fichier->setSeller($this);
        }

        return $this;
    }

    public function removeFichier(Fichier $Fichier): self
    {
        if ($this->Fichiers->removeElement($Fichier)) {
            // set the owning side to null (unless already changed)
            if ($Fichier->getSeller() === $this) {
                $Fichier->setSeller(null);
            }
        }

        return $this;
    }
}
