<?php

namespace App\Entity;

use Assert\Email;
use Assert\NotBlank;
use App\Entity\Cocktail;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"comments", "user", "rating"})
     */
    private $id;

    /**
     * @Assert\Email
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"user"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"user"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Groups({"comments", "user", "rating"})
     * @Assert\NotBlank
     */
    private $pseudonym;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Assert\NotBlank
     * @Groups({"user"})
     */
    private $date_of_birth;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"user"})
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"user"})
     */
    private $last_login;

    /**
     * @ORM\Column(type="boolean", options={"default":0}))
     * @Groups({"user"})
     */
    private $verified;

    /**
     * @ORM\Column(type="integer", options={"default":0}))
     * @Groups({"user"})
     */
    private $warning;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user"})
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity=Cocktail::class, mappedBy="user", cascade={"remove"})
     */
    private $cocktails;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="user", cascade={"remove"})
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="user", orphanRemoval=true)
     */
    private $ratings;

    public function __construct()
    {
        $this->cocktails = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->ratings = new ArrayCollection();
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPseudonym(): ?string
    {
        return $this->pseudonym;
    }

    public function setPseudonym(string $pseudonym): self
    {
        $this->pseudonym = $pseudonym;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeImmutable
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(\DateTimeImmutable $date_of_birth): self
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeImmutable
    {
        return $this->last_login;
    }

    public function setLastLogin(?\DateTimeImmutable $last_login): self
    {
        $this->last_login = $last_login;

        return $this;
    }

    public function isVerified(): ?bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): self
    {
        $this->verified = $verified;

        return $this;
    }

    public function getWarning(): ?int
    {
        return $this->warning;
    }

    public function setWarning(int $warning): self
    {
        $this->warning = $warning;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, Cocktail>
     */
    public function getCocktails(): Collection
    {
        return $this->cocktails;
    }

    public function addCocktail(Cocktail $cocktail): self
    {
        if (!$this->cocktails->contains($cocktail)) {
            $this->cocktails[] = $cocktail;
            $cocktail->setUser($this);
        }

        return $this;
    }

    public function removeCocktail(Cocktail $cocktail): self
    {
        if ($this->cocktails->removeElement($cocktail)) {
            // set the owning side to null (unless already changed)
            if ($cocktail->getUser() === $this) {
                $cocktail->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings[] = $rating;
            $rating->setUser($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getUser() === $this) {
                $rating->setUser(null);
            }
        }

        return $this;
    }
}
