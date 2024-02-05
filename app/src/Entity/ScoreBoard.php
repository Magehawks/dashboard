<?php

namespace App\Entity;

use App\Repository\ScoreBoardRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoreBoardRepository::class)]
class ScoreBoard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Player = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Points = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Time = null;

    #[ORM\Column(length: 255)]
    private ?string $EventName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Link = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?string
    {
        return $this->Player;
    }

    public function setPlayer(string $Player): static
    {
        $this->Player = $Player;

        return $this;
    }

    public function getPoints(): ?string
    {
        return $this->Points;
    }

    public function setPoints(?string $Points): static
    {
        $this->Points = $Points;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->Time;
    }

    public function setTime(?\DateTimeInterface $Time): static
    {
        $this->Time = $Time;

        return $this;
    }

    public function getEventName(): ?string
    {
        return $this->EventName;
    }

    public function setEventName(string $EventName): static
    {
        $this->EventName = $EventName;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->Link;
    }

    public function setLink(?string $Link): static
    {
        $this->Link = $Link;

        return $this;
    }
}
