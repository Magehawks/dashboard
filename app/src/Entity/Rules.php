<?php

namespace App\Entity;

use App\Repository\RulesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RulesRepository::class)]
class Rules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Descrip�tion = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Bosses = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescrip�tion(): ?string
    {
        return $this->Descrip�tion;
    }

    public function setDescrip�tion(string $Descrip�tion): static
    {
        $this->Descrip�tion = $Descrip�tion;

        return $this;
    }

    public function getBosses(): ?string
    {
        return $this->Bosses;
    }

    public function setBosses(?string $Bosses): static
    {
        $this->Bosses = $Bosses;

        return $this;
    }
}
