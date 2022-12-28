<?php

namespace App\Form;

use App\Entity\Pages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class PagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('contents', TextareaType::class, [
                'label' => 'Contenu de l\'article ',
                'required' => false,
                'attr' => [
                    'class' => 'textarea',
                    'placeholder' => 'Le contenu est optionnel',
                ]
            ])
            ->add('contents2', TextareaType::class, [
                'label' => 'Contenu de l\'article ',
                'required' => false,
                'attr' => [
                    'class' => 'textarea',
                    'placeholder' => 'Le contenu est optionnel',
                ]
            ])
            ->add('imgHeader',
                FileType::class,
                [
                    'label' => 'Image de couverture',
                    'mapped' => false,
                    'required' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '5M',
                            'mimeTypes' => [
                                'image/jpeg',
                                'image/webp',
                                'image/png',
                            ],
                            'mimeTypesMessage' => 'Veuillez uploader une image valide', 
                        ])
                    ],
                ],
            )

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pages::class,
        ]);
    }
}
