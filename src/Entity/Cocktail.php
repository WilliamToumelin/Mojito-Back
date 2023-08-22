<?php

namespace App\Entity;

use App\Repository\CocktailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CocktailRepository::class)
 */
class Cocktail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     */
    private $difficulty;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\Column(type="integer")
     */
    private $preparation_time;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $trick;

    /**
     * @ORM\Column(type="boolean")
     */
    private $alcool;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="float")
     */
    private $rating;

    /**
     * @ORM\ManyToMany(targetEntity=Material::class, inversedBy="cocktails")
     */
    private $materials;

    /**
     * @ORM\OneToMany(targetEntity=Step::class, mappedBy="cocktail", orphanRemoval=true)
     */
    private $steps;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="cocktails")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=CocktailUse::class, mappedBy="cocktail")
     */
    private $cocktailUses;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cocktails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="cocktail")
     */
    private $comments;

    public function __construct()
    {
        $this->materials = new ArrayCollection();
        $this->steps = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->cocktailUses = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparation_time;
    }

    public function setPreparationTime(int $preparation_time): self
    {
        $this->preparation_time = $preparation_time;

        return $this;
    }

    public function getTrick(): ?string
    {
        return $this->trick;
    }

    public function setTrick(?string $trick): self
    {
        $this->trick = $trick;

        return $this;
    }

    public function isAlcool(): ?bool
    {
        return $this->alcool;
    }

    public function setAlcool(bool $alcool): self
    {
        $this->alcool = $alcool;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return Collection<int, Material>
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    public function addMaterial(Material $material): self
    {
        if (!$this->materials->contains($material)) {
            $this->materials[] = $material;
        }

        return $this;
    }

    public function removeMaterial(Material $material): self
    {
        $this->materials->removeElement($material);

        return $this;
    }

    /**
     * @return Collection<int, Step>
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Step $step): self
    {
        if (!$this->steps->contains($step)) {
            $this->steps[] = $step;
            $step->setCocktail($this);
        }

        return $this;
    }

    public function removeStep(Step $step): self
    {
        if ($this->steps->removeElement($step)) {
            // set the owning side to null (unless already changed)
            if ($step->getCocktail() === $this) {
                $step->setCocktail(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, CocktailUse>
     */
    public function getCocktailUses(): Collection
    {
        return $this->cocktailUses;
    }

    public function addCocktailUse(CocktailUse $cocktailUse): self
    {
        if (!$this->cocktailUses->contains($cocktailUse)) {
            $this->cocktailUses[] = $cocktailUse;
            $cocktailUse->setCocktail($this);
        }

        return $this;
    }

    public function removeCocktailUse(CocktailUse $cocktailUse): self
    {
        if ($this->cocktailUses->removeElement($cocktailUse)) {
            // set the owning side to null (unless already changed)
            if ($cocktailUse->getCocktail() === $this) {
                $cocktailUse->setCocktail(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $comment->setCocktail($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCocktail() === $this) {
                $comment->setCocktail(null);
            }
        }

        return $this;
    }
}
