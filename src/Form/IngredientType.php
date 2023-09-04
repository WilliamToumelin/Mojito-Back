<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\TypeIngredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        //->add('number_step')
        //->add('content')
        //->add('cocktail');
        ->add('name', TextType::class, [
            "label" => "Nom",
            "attr" => [
                "placeholder" => "Nom de l'ingrédient"
            ]
        ])

         ->add('typeingredient', EntityType::class, [
            'class' => TypeIngredient::class,
            "label" => "Type",
            "attr" => [
                "placeholder" => "Type d'ingrédient"
            ]
            ]);



        //->add('typeingredient');
        //->add('cocktail');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
