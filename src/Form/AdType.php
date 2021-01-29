<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImagesType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

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

            ->add('images', CollectionType::class, [
               'entry_type' => ImagesType::class,
               'entry_options' => ['label' => false],
               'allow_add' => true,
               'allow_delete' => true,
               'by_reference' => false
            ]);

        $preSetData = function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();

            $form->add('coverImage',  FileType::class, [
                'label' => "Image principale",
                'mapped' => false,
                'required' => $data->getCoverImage() ? false : true,
            ]);
        };
        $postSubmit = function (FormEvent $event) {
           
            $data = $event->getData();

            foreach($data->getImages() as $key => $d) {
                if ($d->getNameFile()  === null) {
                    unset($data->getImages()[$key]);
                }
            }
        };

        $builder->addEventListener(FormEvents::PRE_SET_DATA, $preSetData);

        $builder->addEventListener(FormEvents::POST_SUBMIT, $postSubmit);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
