<?php
 namespace App\EventListener;

use App\Entity\Promotion;
use Doctrine\Persistence\ManagerRegistry;

 class PromotionListener
 {
    public function __construct(ManagerRegistry $registry , Promotion $promotion)
    {
        
    }
     public function onEndPromotion()
     {
         // ...
     }
 }