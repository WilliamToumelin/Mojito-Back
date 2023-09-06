<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"cocktailsAllInfo", "categories", "cocktailsBasicInfo"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cocktailsAllInfo", "categories", "cocktailsBasicInfo", "ResponseCocktails"})
     * @Assert\NotBlank
     * @Assert\Length(min = 5, max = 20, minMessage = "Minimum {{ limit }} caractères", maxMessage = "Maximum {{ limit }} caractères")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Cocktail::class, mappedBy="categories", cascade={"remove"})
     */
    private $cocktails;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"categories", "cocktailsBasicInfo"})
     */
    private $slug;

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
            $cocktail->addCategory($this);
        }

        return $this;
    }

    public function removeCocktail(Cocktail $cocktail): self
    {
        if ($this->cocktails->removeElement($cocktail)) {
            $cocktail->removeCategory($this);
        }

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
}
