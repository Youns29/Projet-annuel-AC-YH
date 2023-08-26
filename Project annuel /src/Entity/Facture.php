<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $invoiceDate = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $totalInclTax;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $unitPriceExclTax;

    #[ORM\Column(type: "integer")]
    private $quantity;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $totalExclTax;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $taxAmount;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $designation = null;

    #[ORM\ManyToOne(inversedBy: 'Factures')]
    private ?User $customer = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    // Getter et Setter pour invoiceDate
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;
    }

     // Getter et Setter pour unitPriceExclTax
     public function getUnitPriceExclTax()
     {
         return $this->unitPriceExclTax;
     }
 
     public function setUnitPriceExclTax($unitPriceExclTax)
     {
         $this->unitPriceExclTax = $unitPriceExclTax;
     }
 
     // Getter et Setter pour quantity
     public function getQuantity()
     {
         return $this->quantity;
     }
 
     public function setQuantity($quantity)
     {
         $this->quantity = $quantity;
     }
 
     // Getter et Setter pour totalExclTax
     public function getTotalExclTax()
     {
         return $this->totalExclTax;
     }
 
     public function setTotalExclTax($totalExclTax)
     {
         $this->totalExclTax = $totalExclTax;
     }
 
     // Getter et Setter pour taxAmount
     public function getTaxAmount()
     {
         return $this->taxAmount;
     }
 
     public function setTaxAmount($taxAmount)
     {
         $this->taxAmount = $taxAmount;
     }
 
     // Getter et Setter pour totalInclTax
     public function getTotalInclTax()
     {
         return $this->totalInclTax;
     }
 
     public function setTotalInclTax($totalInclTax)
     {
         $this->totalInclTax = $totalInclTax;
     }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getCustomer(): ?User
    {
        return $this->customer;
    }

    public function setCustomer(?User $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
