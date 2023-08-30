<?php

namespace App\Form;

use App\Entity\CocktailUse;
use App\Entity\Ingredient;
use App\Entity\Unit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CockTailUseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('quantity', IntegerType::class)
        ->add('unit', EntityType::class, [
            "class" => Unit::class,
            "label" => "unit",
            //"expanded" => true,
            "choice_label" => "name"
        ])
        ->add('ingredient', EntityType::class, [
            "class" => Ingredient::class,
            "label" => "ingrédients",
            //"expanded" => true,
            "choice_label" => "name"
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CocktailUse::class,
        ]);
    }
}
