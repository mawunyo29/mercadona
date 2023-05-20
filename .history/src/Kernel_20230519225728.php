<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Vich\UploaderBundle\VichUploaderBundle;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;


    public function registerBundles() : iterable
    {
        $bundles = [
            // ...
            new VichUploaderBundle(),
        ];
        return array_merge(parent::registerBundles(), $bundles);

       
    }
  
    
    
}
