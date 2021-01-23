<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('type', 'Type de la page')->setChoices([
                "page 1",
                "page 2",
                "Page::PAGE3"
            ]),
            TextField::new('title', 'Titre de la page'),
            TextEditorField::new('content', 'Contenu de la page'),
            ImageField::new('illustration')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextareaField::new('btnTitle', 'Titre du bouton'),
            TextareaField::new('btnUrl', 'Url de destination du bouton'),
        ];
    }
}
