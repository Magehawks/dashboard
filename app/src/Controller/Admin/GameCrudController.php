<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Game::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $yearField = ChoiceField::new('releaseYear')
            ->setChoices(array_combine(range(date('Y'), 1900), range(date('Y'), 1900))); // Adjust range as needed

        $platformsField = TextField::new('plattforms');
        $nameField = TextField::new('name');
        $descriptionField = TextareaField::new('description');

        $imageField = ImageField::new('image')
            ->setBasePath('/public/images/') // Adjust accordingly
            ->setUploadDir('/public/images/') // Adjust accordingly
            ->setUploadedFileNamePattern('[randomhash].[extension]');
        return [
            $nameField,
            $imageField,
            $descriptionField,
            $yearField,
            $platformsField,
        ];
    }
}
