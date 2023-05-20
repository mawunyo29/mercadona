<?php

namespace App\Form;

use App\Model\SearchData;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
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
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entity::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
  
}
