<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"cocktailsWithRelations", "typeingredientsWithRelations", "propositionsData"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cocktailsWithRelations", "typeingredientsWithRelations", "propositionsData"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=TypeIngredient::class, inversedBy="ingredients")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"cocktailsWithRelations"})
     */
    private $typeingredient;

    /**
     * @ORM\OneToMany(targetEntity=CocktailUse::class, mappedBy="ingredient")
     */
    private $cocktailUses;

    public function __construct()
    {
        $this->cocktailUses = new ArrayCollection();
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

    public function getTypeingredient(): ?TypeIngredient
    {
        return $this->typeingredient;
    }

    public function setTypeingredient(?TypeIngredient $typeingredient): self
    {
        $this->typeingredient = $typeingredient;

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
            $cocktailUse->setIngredient($this);
        }

        return $this;
    }

    public function removeCocktailUse(CocktailUse $cocktailUse): self
    {
        if ($this->cocktailUses->removeElement($cocktailUse)) {
            // set the owning side to null (unless already changed)
            if ($cocktailUse->getIngredient() === $this) {
                $cocktailUse->setIngredient(null);
            }
        }

        return $this;
    }
}
