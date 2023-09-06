<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                "label" => "Prénom",
                "attr" => [
                    "placeholder" => "Prénom"
                ]
            ])
            ->add('lastname', TextType::class, [
                "label" => "Nom",
                "attr" => [
                    "placeholder" => "Nom"
                ]
            ])
            ->add('pseudonym', TextType::class, [
                "label" => "Pseudo",
                "attr" => [
                    "placeholder" => "pseudo"
                ]
            ])
            ->add('email', EmailType::class, [
                "label" => "Email",
                "attr" => [
                    "placeholder" => "pseudo"
                ]

            ])
            ->add('password', PasswordType::class, [
                "label" => "Mot de passe",
                "attr" => [
                    "placeholder" => "Mot de passe"
                ]
            ])
            ->add('roles', ChoiceType::class, [
                "label" => "Role",
                "attr" => [
                    "placeholder" => "Role"
                ],
                'choices' => [
                    'Admin' => 'ROLE_ADMIN'
                ],
                "disabled" => true
            ])
            ->add('date_of_birth', DateType::class, [
                "label" => "Date de naissance",
                "attr" => [
                    "placeholder" => "Date de naissance"
                ],
                "widget" => "single_text",
                "input" => "datetime_immutable",
            ]);

        //roles field data transformer : https://stackoverflow.com/questions/51744484/symfony-form-choicetype-error-array-to-string-covnersion
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    // transform the array to a string
                    return count($rolesArray) ? $rolesArray[0] : null;
                },
                function ($rolesString) {
                    // transform the string back to an array
                    return [$rolesString];
                }
            ));
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
