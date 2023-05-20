<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

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
        ]);
    }
    
}