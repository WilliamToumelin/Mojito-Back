<?php

namespace App\Entity;

use App\Repository\CocktailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CocktailRepository::class)
 */
class Cocktail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"cocktailsBasicInfo", "cocktailsAllInfo", "comments"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"cocktailsBasicInfo", "cocktailsAllInfo", "comments"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"cocktailsWithRelations", "cocktailsAllInfo"})
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     * @Groups({"cocktailsBasicInfo", "cocktailsAllInfo"})
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"cocktailsBasicInfo", "cocktailsAllInfo"})
     */
    private $difficulty;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"cocktailsAllInfo"})
     */
    private $preparation_time;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"cocktailsAllInfo"})
     */
    private $trick;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"cocktailsAllInfo"})
     */
    private $alcool;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cocktailsAllInfo", "comments"})
     */
    private $slug;

    /**
     * @ORM\Column(type="float")
     * @Groups({"cocktailsBasicInfo", "cocktailsAllInfo"})
     */
    private $rating;

    /**
     * @ORM\OneToMany(targetEntity=Step::class, mappedBy="cocktail", orphanRemoval=true)
     * @Groups({"cocktailsAllInfo"})
     */
    private $steps;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="cocktails")
     * @Groups({"cocktailsAllInfo", "cocktailsBasicInfo"})
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=CocktailUse::class, mappedBy="cocktail")
     * @Groups({"cocktailsAllInfo"})
     */
    private $cocktailUses;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cocktails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="cocktail")
     * @Groups({"comments"})
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="cocktail", orphanRemoval=true)
     */
    private $ratings;

    /**
     * @ORM\ManyToOne(targetEntity=Glass::class, inversedBy="cocktails")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"cocktailsWithRelations"})
     */
    private $glass;

    /**
     * @ORM\ManyToOne(targetEntity=Ice::class, inversedBy="cocktails")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"cocktailsWithRelations"})
     */
    private $ice;

    /**
     * @ORM\ManyToOne(targetEntity=Technical::class, inversedBy="cocktails")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"cocktailsWithRelations"})
     */
    private $technical;

    public function __construct()
    {
        $this->steps = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->cocktailUses = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->ratings = new ArrayCollection();
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
            $rating->setCocktail($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getCocktail() === $this) {
                $rating->setCocktail(null);
            }
        }

        return $this;
    }

    public function getGlass(): ?Glass
    {
        return $this->glass;
    }

    public function setGlass(?Glass $glass): self
    {
        $this->glass = $glass;

        return $this;
    }

    public function getIce(): ?Ice
    {
        return $this->ice;
    }

    public function setIce(?Ice $ice): self
    {
        $this->ice = $ice;

        return $this;
    }

    public function getTechnical(): ?Technical
    {
        return $this->technical;
    }

    public function setTechnical(?Technical $technical): self
    {
        $this->technical = $technical;

        return $this;
    }
}
