<?php

namespace App\Controller\Admin;

use App\Entity\WelcomePage;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WelcomePageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WelcomePage::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('title', 'Titre du header'),
            TextareaField::new('content', 'Contenu du header'),
            TextareaField::new('btnTitle', 'Titre du bouton'),
            TextareaField::new('btnUrl', 'Url de destination du bouton'),
            ImageField::new('illustration')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('newsTitleOne', 'Titre de la News 1'),
            TextareaField::new('newsContentOne', 'Contenu de la News 1'),
            ImageField::new('newsIllustrationOne')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('newsTitleTwo', 'Titre de la News 2'),
            TextareaField::new('newsContentTwo', 'Contenu de la News 2'),
            ImageField::new('newsIllustrationTwo')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }
}
