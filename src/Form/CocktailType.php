<?php

namespace App\Form;

use App\Entity\Ice;
use App\Entity\Step;
use App\Entity\Glass;
use Faker\Core\Number;
use App\Entity\Category;
use App\Entity\Cocktail;
use App\Entity\Technical;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CocktailType extends AbstractType

{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom",
                "attr" => [
                    "placeholder" => "Nom du cocktail"
                ]
            ])
            ->add('description', TextareaType::class, [
                "label" => "Description",
                "attr" => [
                    "placeholder" => "Description du cocktail"
                ]
            ])
            //! TODO : CHANGER L'ENTITE PLUS TARD QUAND AU FINAL L'IMAGE SERA TELECHARGEE
            ->add('picture', UrlType::class, [
                "label" => "Photo",
                "attr" => [
                    "placeholder" => "http://..."
                ]
            ])
            ->add('difficulty', ChoiceType::class, [
                "label" => "Difficulté",
                'choices'  => [
                    'Facile' => 1,
                    'Intermédiaire' => 2,
                    'Difficile' => 3
                ],
            ])
            ->add('visible', ChoiceType::class, [
                'choices'  => [
                    'Oui' => 1,
                    'Non' => 0,
                ],
            ])
            ->add('preparation_time', IntegerType::class, [
                "label" => "Temps de préparation",
                "attr" => [
                    "placeholder" => "saisir un nombre"
                ]
            ])
            ->add('trick', TextType::class, [
                "label" => "Astuce",
                "attr" => [
                    "placeholder" => "Ajouter une astuce"
                ]
            ])
            ->add('alcool', ChoiceType::class, [
                'choices'  => [
                    'Oui' => 1,
                    'Non' => 0,
                ],
            ])
            ->add('categories', EntityType::class, [
                "class" => Category::class,
                "label" => "Categorie",
                //"expanded" => true,
                "multiple" => true,
                "choice_label" => "name"
            ])
            ->add('glass', EntityType::class, [
                "class" => Glass::class,
                "label" => "Verre",
                //"expanded" => true,   
                "choice_label" => "name"
            ])
            ->add('ice', EntityType::class, [
                "class" => Ice::class,
                "label" => "Glaçe",
                //"expanded" => true,
                "choice_label" => "name"
            ])
            ->add('technical', EntityType::class, [
                "class" => Technical::class,
                "label" => "Matériel",
                //"expanded" => true,
                "choice_label" => "name"
            ])

            ->add('steps', CollectionType::class, [
                //'entry_type' => StepType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
               
      
            ]);
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cocktail::class,
        ]);
    }
}
