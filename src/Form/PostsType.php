<?php

namespace App\Form;

use App\Entity\Posts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class PostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre de l\'article *',
                'attr' => [
                    'placeholder' => 'Le titre de l\'article ne doit pas faire plus de 70 caractère comme le texte ici 70 ...',
                ]
            ])
            ->add('contents', null, [
                'label' => 'Contenu de l\'article *',
                'attr' => [
                    'placeholder' => 'Le Premier contenu est obligatoire',
                ]
            ])
            ->add('subtitle', null, [
                'label' => 'Sous-titre de l\'article ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Le sous-titre de l\'article ne doit pas faire plus de 70 caractère comme le texte ici 70 ...',
                ]
            ])
            ->add('contents2', null, [
                'label' => 'Contenu de l\'article 2',
                'attr' => [
                    'placeholder' => 'Le Second contenu est optionnel',
                ]
            ])
            ->add('imgPost',
                    FileType::class,
                        [
                            'label' => 'Image de couverture *',
                            'required' => true,
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
                        ],)
            ->add('imgPost2',
                    FileType::class,
                        [
                            'label' => 'Image 2',
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
                        ],)
            ->add('imgPost3',
                    FileType::class,
                        [
                            'label' => 'Image 3',
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
                        ],)
            ->add('imgPost4',
                    FileType::class,
                        [
                            'label' => 'Image 4',
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
                        ],)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Posts::class,
        ]);
    }
}
