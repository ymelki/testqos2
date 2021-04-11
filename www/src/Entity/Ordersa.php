<?php

namespace App\Entity;

use App\Repository\OrdersaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersaRepository::class)
 */
class Ordersa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\OneToMany(targetEntity=Bl::class, mappedBy="ordersa")
     */
    private $bls;

    public function __construct()
    {
        $this->bls = new ArrayCollection();
    }


    public function __toString() {
        return strval($this->id);
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection|Bl[]
     */
    public function getBls(): Collection
    {
        return $this->bls;
    }

    public function addBl(Bl $bl): self
    {
        if (!$this->bls->contains($bl)) {
            $this->bls[] = $bl;
            $bl->setOrdersa($this);
        }

        return $this;
    }

    public function removeBl(Bl $bl): self
    {
        if ($this->bls->removeElement($bl)) {
            // set the owning side to null (unless already changed)
            if ($bl->getOrdersa() === $this) {
                $bl->setOrdersa(null);
            }
        }

        return $this;
    }
}
