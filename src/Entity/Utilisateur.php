<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"default"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"default"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"default"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"default"})
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity=Reclamation::class, mappedBy="Utilisateur")
     */
    private $reclamations;


    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $password;
    /**
     * @ORM\Column(name="is_deleted", type="boolean")
     * @Groups({"default"})  
     */
    private $isDeleted=false;

    /**
     * @ORM\Column(name="is_active", type="boolean")

     */


    private $isActive;
    public function __construct()
    {
        $this->reclamations = new ArrayCollection();
        $this->isActive = true;

    }

    public function getIsDeleted()
    {
        return $this->isDeleted;
    }
    public function getRoles()
    {
        return array('ROLE_USER');
    }
	/**
 	* @see UserInterface
 	*/
     public function getSalt()
     {
             // not needed when using the "bcrypt" algorithm in security.yaml
     }
 	/**
 	* @see UserInterface
 	*/
     public function eraseCredentials()
     {
             // If you store any temporary, sensitive data on the user, clear it here
             // $this->plainPassword = null;
     }
public function getUsername()
{
    return $this->username;
}
public function getPassword()
{
    return $this->password;
}

public function setPassword($password)
{
    $this->password = $password;
}
public function setUsername($username)
{
    $this->username = $username;
}


    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Reclamation[]
     */
    public function getReclamations(): Collection
    {
        return $this->reclamations;
    }

    public function addReclamation(Reclamation $reclamation): self
    {
        if (!$this->reclamations->contains($reclamation)) {
            $this->reclamations[] = $reclamation;
            $reclamation->setUtilisateur($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): self
    {
        if ($this->reclamations->removeElement($reclamation)) {
            // set the owning side to null (unless already changed)
            if ($reclamation->getUtilisateur() === $this) {
                $reclamation->setUtilisateur(null);
            }
        }

        return $this;
    }
}
