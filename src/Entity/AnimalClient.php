<?php

namespace App\Entity;

use App\Repository\AnimalClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalClientRepository::class)]
class AnimalClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $nomAnimal = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateNaissance = null;

    #[ORM\ManyToOne(inversedBy: 'typeAnimal')]
    private ?Client $client = null;

    #[ORM\ManyToOne(inversedBy: 'animalClients')]
    private ?Animaux $typeAnimal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAnimal(): ?string
    {
        return $this->nomAnimal;
    }

    public function setNomAnimal(string $nomAnimal): static
    {
        $this->nomAnimal = $nomAnimal;

        return $this;
    }

    public function getDateNaissance(): ?\DateTime
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTime $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getTypeAnimal(): ?Animaux
    {
        return $this->typeAnimal;
    }

    public function setTypeAnimal(?Animaux $typeAnimal): static
    {
        $this->typeAnimal = $typeAnimal;

        return $this;
    }
}
