<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(
 *  fields={"email"},
 *  message="Un autre utilisateur s'est déjà inscrit avec cette adresse email, merci de la modifier"
 * )
 */
class User implements UserInterface
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

    /**
     * @ORM\OneToMany(targetEntity=Bl::class, mappedBy="user_info", orphanRemoval=true)
     */
    private $bls;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $magasin;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Code_client;

    public function __construct()
    {
        $this->bls = new ArrayCollection();
    }

    public function __toString()
    {
        
        return $this->magasin;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    
    public function eraseCredentials() {}
    public function getSalt() {}

    public function getUsername() {
        $mail=$this->email;
        return $mail;
    }
    

    public function getRoles() {
        
        return array_unique(array_merge(['ROLE_USER'], $this->roles));
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

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
            $bl->setUserInfo($this);
        }

        return $this;
    }

    public function removeBl(Bl $bl): self
    {
        if ($this->bls->removeElement($bl)) {
            // set the owning side to null (unless already changed)
            if ($bl->getUserInfo() === $this) {
                $bl->setUserInfo(null);
            }
        }

        return $this;
    }

    public function getMagasin(): ?string
    {
        return $this->magasin;
    }

    public function setMagasin(string $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getCodeClient(): ?string
    {
        return $this->Code_client;
    }

    public function setCodeClient(string $Code_client): self
    {
        $this->Code_client = $Code_client;

        return $this;
    }

}
