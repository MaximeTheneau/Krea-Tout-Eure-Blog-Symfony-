<?php

namespace App\Form;

use App\Entity\Posts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class PostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'article *',
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Le titre de l\'article ne doit pas faire plus de 70 caractère comme le texte ici 70 ...',
                ]
            ])
            ->add('contents', TextareaType::class, [
                'label' => 'Contenu de l\'article ',
                'required' => false,
                'attr' => [
                    'class' => 'textarea',
                    'placeholder' => 'Le contenu est optionnel',
                ]
            ])
            ->add('subtitle', TextType::class, [
                'label' => 'Sous-titre de l\'article ',
                'required' => false,
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Le sous-titre de l\'article ne doit pas faire plus de 70 caractère comme le texte ici 70 ...',
                ]
            ])
            ->add('contents2', TextareaType::class, [
                'label' => 'Contenu de l\'article 2',
                'required' => false,
                'attr' => [
                    'class' => 'textarea',
                    'placeholder' => 'Le Second contenu est optionnel',
                ]
            ])
            ->add('imgPost', FileType::class, [
                'label' => 'Image de couverture *',
                'required' => false,
                'data_class' => null,
                'mapped' => false,
                'attr' => [
                    'class' => 'input',
                ],
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
            ->add('imgPost2', FileType::class, [
                'label' => '2ème image de l\'article',
                'required' => false,
                'data_class' => null,
                'mapped' => false,
                'attr' => [
                    'class' => 'input',
                ],
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
            ->add('imgPost3', FileType::class, [
                'attr' => [
                    'class' => 'input',
                ],
                'label' => '3ème image de l\'article',
                'required' => false,
                'data_class' => null,
                'mapped' => false,
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
            ->add('imgPost4', FileType::class, [
                'label' => '4ème image de l\'article',
                'attr' => [
                    'class' => 'input',
                ],
                'required' => false,
                'data_class' => null,
                'mapped' => false,
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
