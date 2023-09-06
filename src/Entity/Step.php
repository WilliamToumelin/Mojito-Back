<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=StepRepository::class)
 */
class Step
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"cocktailsAllInfo"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"cocktailsAllInfo", "ResponseCocktails"})
     * @Assert\NotBlank
     */
    private $number_step;

    /**
     * @ORM\Column(type="text")
     * @Groups({"cocktailsAllInfo", "ResponseCocktails"})
     * @Assert\NotBlank
     * @Assert\Length(min = 20, max = 50, minMessage = "Minimum {{ limit }} caractères", maxMessage = "Maximum {{ limit }} caractères") 
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Cocktail::class, inversedBy="steps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cocktail;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNumberStep(): ?int
    {
        return $this->number_step;
    }

    public function __toString()
    {
        return $this->content;
    }

    public function setNumberStep(int $number_step): self
    {
        $this->number_step = $number_step;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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
