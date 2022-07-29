<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $project = new Project();
        $project->getUser($this->getUser());

        return $project;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('file', 'Image')->setUploadDir('/public/uploads/realisations/')->setUploadedFileNamePattern('[uuid].[extension]')->hideOnIndex(),
            ImageField::new('file', 'Image')->setBasePath('/uploads/realisations/')->onlyOnIndex(),
            TextField::new('name', 'Titre'),
            TextareaField::new('content', 'Description')->hideOnIndex(),
            DateField::new('date'),
            BooleanField::new('isVisible', 'Visible'),
            UrlField::new('link', 'Lien')->hideOnIndex(),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
            AssociationField::new('category', 'Catégories'),
        ];
    }
}
