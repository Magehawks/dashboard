<?php

namespace App\Controller\Admin;

use App\Entity\DataPrivacy;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DataPrivacyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DataPrivacy::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('content'),
        ];
    }

}
