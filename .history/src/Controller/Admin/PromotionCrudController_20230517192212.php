<?php

namespace App\Controller\Admin;

use App\Entity\Promotion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PromotionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Promotion::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('promotion_start'),
            DateTimeField::new('promotion_end'),
            TextField::new('promotion_rate')
            ->setHelp('Veuillez saisir un nombre entier entre 0 et 100')
            ->setFormTypeOption('attr', ['min' => 0, 'max' => 100])
            ->setFormTypeOption('empty_data', '0')
            ->setFormTypeOption('required', true)
            
        ];
    }
    
}
