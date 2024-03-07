<?php

namespace App\Controller\Admin;

use App\Entity\Impress;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ImpressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Impress::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('content'),
        ];
    }
}
