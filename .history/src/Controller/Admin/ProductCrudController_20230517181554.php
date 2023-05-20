<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('wording');
        yield TextareaField::new('product_description');
        yield TextField::new('product_price');
        yield TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex();
        yield ImageField::new('imageName')->setBasePath('/images/products')->hideOnForm();
        yield AssociationField::new('category');
        yield AssociationField::new('promotions')
        //hidden id field and show only promotion rate
        ->hideOnIndex()
        ->hideOnDetail()
        ->setFormTypeOption('by_reference', false)
        ->setFormTypeOption('multiple', true)
        ->setFormTypeOption('choice_label', 'promotion_rate')
            ;
       
    }
}
