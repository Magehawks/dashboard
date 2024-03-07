<?php

namespace App\Controller\Admin;

use App\Entity\Rules;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RulesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rules::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
