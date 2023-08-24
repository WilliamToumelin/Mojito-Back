<?php

namespace App\Entity;

use App\Repository\UnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=UnitRepository::class)
 */
class Unit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"cocktailsWithRelations"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cocktailsWithRelations"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=CocktailUse::class, mappedBy="unit")
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
            $cocktailUse->setUnit($this);
        }

        return $this;
    }

    public function removeCocktailUse(CocktailUse $cocktailUse): self
    {
        if ($this->cocktailUses->removeElement($cocktailUse)) {
            // set the owning side to null (unless already changed)
            if ($cocktailUse->getUnit() === $this) {
                $cocktailUse->setUnit(null);
            }
        }

        return $this;
    }
}
