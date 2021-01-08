<?php

namespace App\Controller\Admin;

use App\Entity\Ad;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ad::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('coverImage', 'Image principale')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('name', 'Nom'),
            TextField::new('type'),
            NumberField::new('age'),
            ChoiceField::new('sexe')->setChoices([
                'Male' => 0,
                'Femelle' => 1
            ]),
            ChoiceField::new('size', 'Taille')->setChoices([
                'Petit' => 0,
                'Moyen' => 1,
                'Grand' => 2
            ]),
            TextField::new('city', 'Ville'),
            TextField::new('introduction'),
            TextEditorField::new('content', 'Contenu'),
            //ImageField::new('images')
            //    ->setBasePath('uploads/')
            //    ->setUploadDir('public/uploads')
            //    ->setUploadedFileNamePattern('[randomhash].[extension]')
            //    ->setRequired(false),
        ];
    }
}
