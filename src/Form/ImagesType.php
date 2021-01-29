<?php

namespace App\Form;

use App\Entity\Images;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder
        //     ->add('nameFile', FileType::class, [
        //         'label' => false,
        //         'mapped' => false,
        //         'required' => false
        //     ]);

            $builder
            ->add('nameFile',VichImageType::class, [
                'required' => false,
                'attr' => [
                    'width' => '50px',
                    'height' => '50px'      
                ]
            ]);      
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Images::class,
        ]);
    }
}
