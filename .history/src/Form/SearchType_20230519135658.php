<?php

namespace App\Form;

use App\Model\SearchData;
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
        ]);
        $builder->get('search')->addModelTransformer(new CallbackTransformer(
            function ($searchTerm) {
                return new SearchData($searchTerm);
            },
            function ($searchData) {
                return $searchData instanceof SearchData ? $searchData->getSearchTerm() : '';
            }
        ));
    }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'data_class' => SearchData::class,
    //         'method' => 'GET',
    //         'csrf_protection' => false,
    //     ]);
    // }
  
}
