<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('lastName', 'Nom'),
            TextField::new('firstName', 'Prénom'),
            EmailField::new('email'),
            TextField::new('phone', 'Téléphone'),
            ImageField::new('picture', 'Avatar')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('introduction'),
            TextEditorField::new('description'),
            AssociationField::new('ads', "Nombres d'annonces"),
        ];
    }
    
}
