<?php

namespace App\Controller\Admin;

use App\Entity\Promotion;
use Doctrine\DBAL\Types\DecimalType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;


class PromotionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Promotion::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            DateTimeField::new('promotion_start','Début de la promotion'),
            DateTimeField::new('promotion_end' ,'Fin de la promotion'),
            NumberField::new('promotion_rate','Taux de promotion')
            ->setHelp('Veuillez saisir un nombre entier entre 0 et 100')
            ->setFormTypeOption('attr', ['min' => 0, 'max' => 100])
            ->setFormTypeOption('empty_data', '0')
            ->setFormTypeOption('required', true), 
        ];
    }

    //afficher la valeur promotion_rate de la promotion dans la liste des produits

    public function toString($object)
    {
        return $object instanceof Promotion
            ? $object->getPromotionRate() . '%'
            : 'Promotion'; // shown in the breadcrumb on the create view
    }

    //

}
