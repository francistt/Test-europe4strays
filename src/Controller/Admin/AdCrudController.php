<?php

namespace App\Controller\Admin;

use App\Entity\Ad;
use App\Form\ImagesType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
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
            CollectionField::new('images', 'Autre images')
                ->setEntryType(ImagesType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms()
        ];
    } 

    public function configureActions(Actions $actions): Actions
    {
        return $actions->remove(Crud::PAGE_INDEX, Action::NEW);
    }
}
