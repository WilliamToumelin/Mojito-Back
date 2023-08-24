<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=MaterialRepository::class)
 */
class Material
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
     * @ORM\ManyToOne(targetEntity=TypeMaterial::class, inversedBy="materials")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"cocktailsWithRelations"})
     */
    private $typematerial;

    /**
     * @ORM\ManyToMany(targetEntity=Cocktail::class, mappedBy="materials")
     */
    private $cocktails;

    public function __construct()
    {
        $this->cocktails = new ArrayCollection();
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

    public function getTypematerial(): ?TypeMaterial
    {
        return $this->typematerial;
    }

    public function setTypematerial(?TypeMaterial $typematerial): self
    {
        $this->typematerial = $typematerial;

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
            $cocktail->addMaterial($this);
        }

        return $this;
    }

    public function removeCocktail(Cocktail $cocktail): self
    {
        if ($this->cocktails->removeElement($cocktail)) {
            $cocktail->removeMaterial($this);
        }

        return $this;
    }
}
