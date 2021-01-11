<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom :',
                'attr' => [
                    'placeholder' => "Le petit nom de l'animal"
                ]
            ])
            ->add('type', TextType::class, [
                'label' => 'Race :',
                'attr' => [
                    'placeholder' => "Indiquez la race de l'animal"
                ]
            ])
            ->add('age', IntegerType::class, [
                'label' => 'Son age :',
                'attr' => [
                    'placeholder' => "Indiquez son âge"
                ]
            ])
            ->add('sexe', ChoiceType::class, [
                'label' => "Genre",
                'choices' => array_flip([
                    'Male',
                    'Femelle'
                ]),
                'expanded' => true
            ])
            ->add('size', ChoiceType::class, [
                'label' => "Sa taille :",
                'choices' => array_flip([
                    'Petit',
                    'Moyen',
                    'Grand'
                ]),
            ])
            ->add('city', TextType::class, [
                'label' => 'Lieu où il se trouve :',
                'attr' => [
                    'placeholder' => "Indiquez une ville"
                ]
            ])
            ->add('introduction', TextType::class, [
                'label' => 'Introduction :',
                'attr' => [
                    'placeholder' => "Donnez une description globale de l'animal"
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Description détaillée :',
                'attr' => [
                    'placeholder' => "Décrivez le en détail"
                ]
            ])
            ->add('coverImage',  FileType::class, [
                'label' => "Image principale",
                'mapped' => false,
                'required' => false,
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('images2', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
