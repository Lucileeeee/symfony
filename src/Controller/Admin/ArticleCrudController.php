<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;



class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', "Titre"),
            TextareaField::new('content', "Contenu")->setMaxLength(30),
            DateTimeField::new('createAt', "Date de Création")->renderAsNativeWidget(true),
            AssociationField::new('author', "Auteur")->autocomplete()->hideOnIndex(),
            AssociationField::new('categories', "Catégories")->autocomplete()->hideOnIndex(),
        ];
    }
   
}

