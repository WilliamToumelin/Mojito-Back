<?php

namespace App\Entity;

use App\Repository\TypeIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=TypeIngredientRepository::class)
 */
class TypeIngredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"cocktailsWithRelations", "typeingredientsWithRelations"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cocktailsWithRelations", "typeingredientsWithRelations"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Ingredient::class, mappedBy="typeingredient")
     * @Groups({"typeingredientsWithRelations"})
     */
    private $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
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

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setTypeingredient($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getTypeingredient() === $this) {
                $ingredient->setTypeingredient(null);
            }
        }

        return $this;
    }
}
