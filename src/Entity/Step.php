<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StepRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;


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
     * @Groups({"cocktailsAllInfo"})
     */
    private $number_step;

    /**
     * @ORM\Column(type="text")
     * @Groups({"cocktailsAllInfo"})
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
        return $this->cocktail;
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
