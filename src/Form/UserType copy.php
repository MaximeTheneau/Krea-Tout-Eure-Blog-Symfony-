<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('email', null, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'input is-primary',
                    'placeholder' => 'Email',
                ],
            ])
       
            ->add('password', PasswordType::class, [
                // Pour le form d'édition, on n'associe pas le password à l'entité
                // @link https://symfony.com/doc/current/reference/forms/types/form.html#mapped
                // avec cette option : le handleRequest() ne remplira pas le mot de passe dans l'entity user
                'mapped' => false,
                'attr' => [
                    'class' => 'input is-primary',
                    'placeholder' => 'Laissez vide si inchangé'
                ],
                'constraints' => [
                    new NotBlank(),
                    #new Regex(
                    #    "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/",
                    #    "Le mot de passe doit contenir au minimum 8 caractères, une majuscule, un chiffre et un caractère spécial"
                    #),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
