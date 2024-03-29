<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column(length: 180, unique: true, nullable: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 180, unique: true, nullable: true)]
    private $steamUsername = null;

    #[ORM\Column(length: 180, nullable: true)]
    private $livingCity = null;

    #[ORM\Column(length: 180, nullable: true)]
    private $livingCountry = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $verificationToken;

    #[ORM\Column(type: 'boolean')]
    private $isRegistered = false;

    #[ORM\Column(type: 'boolean')]
    private $isSupport = false;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $resetToken;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $resetTokenExpiresAt;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSteamUsername()
    {
        return $this->steamUsername;
    }

    /**
     * @param mixed $steamUsername
     */
    public function setSteamUsername($steamUsername): void
    {
        $this->steamUsername = $steamUsername;
    }

    /**
     * @return mixed
     */
    public function getLivingCity()
    {
        return $this->livingCity;
    }

    /**
     * @param mixed $livingCity
     */
    public function setLivingCity($livingCity): void
    {
        $this->livingCity = $livingCity;
    }

    /**
     * @return mixed
     */
    public function getLivingCountry()
    {
        return $this->livingCountry;
    }

    /**
     * @param mixed $livingCountry
     */
    public function setLivingCountry($livingCountry): void
    {
        $this->livingCountry = $livingCountry;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): void
    {
        $this->isVerified = $isVerified;
    }

    /**
     * @return mixed
     */
    public function getVerificationToken()
    {
        return $this->verificationToken;
    }

    /**
     * @param mixed $verificationToken
     */
    public function setVerificationToken($verificationToken): void
    {
        $this->verificationToken = $verificationToken;
    }

    public function isRegistered(): bool
    {
        return $this->isRegistered;
    }

    public function setIsRegistered(bool $isRegistered): void
    {
        $this->isRegistered = $isRegistered;
    }

    public function isSupport(): bool
    {
        return $this->isSupport;
    }

    public function setIsSupport(bool $isSupport): void
    {
        $this->isSupport = $isSupport;
    }

    /**
     * @return mixed
     */
    public function getResetToken()
    {
        return $this->resetToken;
    }

    /**
     * @param mixed $resetToken
     */
    public function setResetToken($resetToken): void
    {
        $this->resetToken = $resetToken;
    }

    /**
     * @return mixed
     */
    public function getResetTokenExpiresAt()
    {
        return $this->resetTokenExpiresAt;
    }

    /**
     * @param mixed $resetTokenExpiresAt
     */
    public function setResetTokenExpiresAt($resetTokenExpiresAt): void
    {
        $this->resetTokenExpiresAt = $resetTokenExpiresAt;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
