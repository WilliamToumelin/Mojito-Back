<?php

namespace App\Entity;

use App\Repository\CocktailUseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=CocktailUseRepository::class)
 */
class CocktailUse
{
    /**
     * @ORM\Column(type="float")
     * @Groups({"cocktailsWithRelations"})
     */
    private $quantity;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Ingredient::class, inversedBy="cocktailUses")
     * @Groups({"cocktailsWithRelations"})
     */
    private $ingredient;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Unit::class, inversedBy="cocktailUses")
     * @Groups({"cocktailsWithRelations"})
     */
    private $unit;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Cocktail::class, inversedBy="cocktailUses")
     */
    private $cocktail;

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getCocktail(): ?Cocktail
    {
        return $this->cocktail;
    }

    public function setCocktail(?Cocktail $cocktail): self
    {
        $this->cocktail = $cocktail;

        return $this;
    }
}
