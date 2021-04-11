<?php

namespace App\Entity;

use App\Repository\BlRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity(repositoryClass=BlRepository::class)
 */
class Bl
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer") 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $produit;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Livraison::class, inversedBy="bl_livraison")
     * @ORM\JoinColumn(nullable=false)
     */
    private $livraison;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="bls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_info;

    /**
     * @ORM\Column(type="string", length=800)
     */
    private $designation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $porteur;

    /**
     * @ORM\ManyToOne(targetEntity=Ordersa::class, inversedBy="bls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ordersa;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;



    public function __toString() {
        return $this->designation;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?string
    {
        return $this->produit;
    }

    public function setProduit(string $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): self
    {
        $this->livraison = $livraison;

        return $this;
    }

    public function getUserInfo(): ?user
    {
        return $this->user_info;
    }

    public function setUserInfo(?user $user_info): self
    {
        $this->user_info = $user_info;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getPorteur(): ?string
    {
        return $this->porteur;
    }

    public function setPorteur(string $porteur): self
    {
        $this->porteur = $porteur;

        return $this;
    }

    public function getOrdersa(): ?Ordersa
    {
        return $this->ordersa;
    }

    public function setOrdersa(?Ordersa $ordersa): self
    {
        $this->ordersa = $ordersa;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

  

   

    
}
