<?php

namespace App\Form;

use App\Entity\Category;
use App\Model\SearchData;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('search', TextType::class, [
            'label' => 'Search',
            'attr' => [
                'placeholder' => 'Search',
                'class' => 'form-control',
            ],
            'required' => false,
        ])
        ->add('categories', EntityType::class, [
            'label' => 'Categories',
            'attr' => [
                'placeholder' => 'Categories',
                'class' => 'form-control',
            ],
            'class' => Category::class,
            'choice_label' => 'wording',
            'multiple' => true,
            'expanded' => true,
            'required' => false,
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
  
}
