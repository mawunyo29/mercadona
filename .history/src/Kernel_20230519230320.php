<?php

namespace App;

use Liip\ImagineBundle\LiipImagineBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;


    public function registerBundles(): array
    {
        return array(
            // ...

            new LiipImagineBundle(),
        );

        // ...
    }
    
    
}
