<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $nom = null;

    #[ORM\Column(length: 80)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\OneToOne(mappedBy: 'client', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    /**
     * @var Collection<int, AnimalClient>
     */
    #[ORM\OneToMany(targetEntity: AnimalClient::class, mappedBy: 'client')]
    private Collection $animalClients;

    public function __construct()
    {
        $this->animalClients = new ArrayCollection();
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getClient() !== $this) {
            $user->setClient($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, AnimalClient>
     */
    public function getAnimalClients(): Collection
    {
        return $this->animalClients;
    }

    public function addAnimalClients(AnimalClient $animalClients): static
    {
        if (!$this->animalClients->contains($animalClients)) {
            $this->animalClients->add($animalClients);
            $animalClients->setClient($this);
        }

        return $this;
    }

    public function removeAnimalClients(AnimalClient $animalClients): static
    {
        if ($this->animalClients->removeElement($animalClients)) {
            // set the owning side to null (unless already changed)
            if ($animalClients->getClient() === $this) {
                $animalClients->setClient(null);
            }
        }

        return $this;
    }
}
