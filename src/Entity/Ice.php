<?php

namespace App\Entity;

use App\Repository\IceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=IceRepository::class)
 */
class Ice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"ices", "propositionsData", "cocktailsAllInfo"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"ices", "propositionsData", "cocktailsAllInfo"})
     * @Assert\NotBlank
     * @Assert\Length(max=50)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Cocktail::class, mappedBy="ice", cascade={"remove"})
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
            $cocktail->setIce($this);
        }

        return $this;
    }

    public function removeCocktail(Cocktail $cocktail): self
    {
        if ($this->cocktails->removeElement($cocktail)) {
            // set the owning side to null (unless already changed)
            if ($cocktail->getIce() === $this) {
                $cocktail->setIce(null);
            }
        }

        return $this;
    }
}
