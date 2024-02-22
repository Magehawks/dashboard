<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $releaseYear = null;

    #[ORM\Column(length: 255)]
    private ?string $plattforms = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getReleaseYear(): ?string
    {
        return $this->releaseYear;
    }

    public function setReleaseYear(?string $releaseYear): void
    {
        $this->releaseYear = $releaseYear;
    }

    public function getPlattforms(): ?string
    {
        return $this->plattforms;
    }

    public function setPlattforms(?string $plattforms): void
    {
        $this->plattforms = $plattforms;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function upload()
    {
        if ($this->image instanceof UploadedFile) {
            $filesystem = new Filesystem();
            $targetDirectory = __DIR__.'/../../public/images'; // Adjust the path as needed
            $newFilename = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $this->name))).'.'.$this->image->guessExtension();

            try {
                // Move the file to the target directory with the new name
                $this->image->move($targetDirectory, $newFilename);
                // Update the image property to reflect the new filename
                $this->image = $newFilename;
            } catch (IOExceptionInterface $exception) {
                // Handle errors, e.g., log them or throw an exception
                echo "An error occurred while moving the file ".$exception->getPath();
            }
        }
    }
}
