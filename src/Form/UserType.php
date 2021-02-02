<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => "Prénom",
                'attr' => [
                    'placeholder' => "Votre prénom"
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => "Nom",
                'attr' => [
                    'placeholder' => "Votre nom"
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => "Email",
                'attr' => [
                    'placeholder' => "Votre adresse email"
                ]
            ])
            ->add('picture',  FileType::class, [
                'label' => "Photo de profil",
                'mapped' => false,
                'required' => false,
            ])
            ->add('introduction', TextType::class, [
                'label' => "Introduction",
                'attr' => [
                    'placeholder' => "Présentez-vous en quelques mots"
                ]
            ])
            ->add('description', CKEditorType::class, [
                'label' => "Présentez vous, votre association...",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
