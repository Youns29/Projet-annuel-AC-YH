<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $totalspace = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Fichier::class)]
    private Collection $Fichiers;

    public function __construct()
    {
        $this->Fichiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTotalSpace(): ?string
    {
        return $this->totalspace;
    }

    public function setTotalSpace(string $totalspace): self
    {
        $this->totalspace = $totalspace;

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
            $Fichier->setCategory($this);
        }

        return $this;
    }

    public function removeFichier(Fichier $Fichier): self
    {
        if ($this->Fichiers->removeElement($Fichier)) {
            // set the owning side to null (unless already changed)
            if ($Fichier->getCategory() === $this) {
                $Fichier->setCategory(null);
            }
        }

        return $this;
    }
}
