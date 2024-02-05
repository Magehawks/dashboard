<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?object $Rules = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?object $Description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getRules(): ?object
    {
        return $this->Rules;
    }

    public function setRules(object $Rules): static
    {
        $this->Rules = $Rules;

        return $this;
    }

    public function getDescription(): ?object
    {
        return $this->Description;
    }

    public function setDescription(object $Description): static
    {
        $this->Description = $Description;

        return $this;
    }
}
