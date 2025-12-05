<?php

namespace App\Entity;

use App\Repository\AnimauxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimauxRepository::class)]
class Animaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'animauxes')]
    private Collection $produit;

    /**
     * @var Collection<int, AnimalClient>
     */
    #[ORM\OneToMany(targetEntity: AnimalClient::class, mappedBy: 'typeAnimal')]
    private Collection $animalClients;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
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

    /**
     * @return Collection<int, Produit>
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produit->contains($produit)) {
            $this->produit->add($produit);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        $this->produit->removeElement($produit);

        return $this;
    }

    /**
     * @return Collection<int, AnimalClient>
     */
    public function getAnimalClients(): Collection
    {
        return $this->animalClients;
    }

    public function addAnimalClient(AnimalClient $animalClient): static
    {
        if (!$this->animalClients->contains($animalClient)) {
            $this->animalClients->add($animalClient);
            $animalClient->setTypeAnimal($this);
        }

        return $this;
    }

    public function removeAnimalClient(AnimalClient $animalClient): static
    {
        if ($this->animalClients->removeElement($animalClient)) {
            // set the owning side to null (unless already changed)
            if ($animalClient->getTypeAnimal() === $this) {
                $animalClient->setTypeAnimal(null);
            }
        }

        return $this;
    }
}
