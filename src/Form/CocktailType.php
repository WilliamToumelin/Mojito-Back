<?php

namespace App\Form;

use App\Entity\Ice;
use App\Entity\Glass;
use App\Entity\Category;
use App\Entity\Cocktail;
use App\Entity\Technical;
use App\Entity\CocktailUse;
use App\Form\CockTailUseType;
use Doctrine\ORM\QueryBuilder;
use App\Repository\IceRepository;
use App\Repository\GlassRepository;
use App\Repository\CategoryRepository;
use App\Repository\TechnicalRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
                ],
            ])
            ->add('description', TextAreaType::class, [
                "label" => "Description",
                "attr" => [
                    "placeholder" => "Description du cocktail"
                ]

            ])
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
                    "placeholder" => "saisir un nombre",
                    "min" => 1
                ]
            ])
            ->add('trick', TextType::class, [
                "label" => "Astuce",
                "attr" => [
                    "placeholder" => "Ajouter une astuce"
                ],
                'required' => false,
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
                //https://symfony.com/doc/current/reference/forms/types/entity.html#using-a-custom-query-for-the-entities
                'query_builder' => function (CategoryRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                "multiple" => true,
                "choice_label" => "name"
            ])
            ->add('glass', EntityType::class, [
                "class" => Glass::class,
                'query_builder' => function (GlassRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.name', 'ASC');
                },
                "label" => "Verre",
                //"expanded" => true,   
                "choice_label" => "name"
            ])
            ->add('ice', EntityType::class, [
                "class" => Ice::class,
                'query_builder' => function (IceRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.name', 'ASC');
                },
                "label" => "Glaçon",
                //"expanded" => true,
                "choice_label" => "name"
            ])
            ->add('technical', EntityType::class, [
                "class" => Technical::class,
                'query_builder' => function (TechnicalRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.name', 'ASC');
                },
                "label" => "technique",
                //"expanded" => true,
                "choice_label" => "name"
            ])

            // https://symfony.com/doc/current/form/form_collections.html

            ->add('steps', CollectionType::class, [
                'entry_type' => StepType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,    //https://symfony.com/doc/current/reference/forms/types/collection.html#field-options
                'allow_delete' => true, // https://symfony.com/doc/current/reference/forms/types/collection.html#allow-delete
                'by_reference' => false, // https://symfony.com/doc/current/reference/forms/types/collection.html#by-reference
                'label' => false,
            ])

            ->add('cocktailuses', CollectionType::class, [
                'entry_type' => CockTailUseType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,    //https://symfony.com/doc/current/reference/forms/types/collection.html#field-options
                'allow_delete' => true, // https://symfony.com/doc/current/reference/forms/types/collection.html#allow-delete
                'by_reference' => false, // https://symfony.com/doc/current/reference/forms/types/collection.html#by-reference 
                'label' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cocktail::class,
            'error_bubbling' => true,

        ]);
    }
}
