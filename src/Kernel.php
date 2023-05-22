<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;


    // public function registerBundles(): iterable
    // {
    //     $contents = require $this->getProjectDir().'/config/bundles.php';
    //     foreach ($contents as $class => $envs) {
    //         if (isset($envs['all']) || isset($envs[$this->getEnvironment()])) {
    //             yield new $class();
    //         }
    //     }

    // }
    
    
}
