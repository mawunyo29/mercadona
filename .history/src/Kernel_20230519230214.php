<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;


    public function registerBundles(): array
    {
        return array(
            // ...

            new Liip\ImagineBundle\LiipImagineBundle(),
        );

        // ...
    }
    
    
}
