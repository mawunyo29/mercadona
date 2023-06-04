<?php
 namespace App\EventListener;

use App\Entity\Promotion;
use App\Event\ProductEndPromotionEvent;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: ProductEndPromotionEvent::class ,method: 'onEndPromotion')]
 class PromotionListener
 {
    private ProductRepository $productRepository;
    public function __construct( private readonly LoggerInterface $logger ,ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
   
   
     public function onEndPromotion(ProductEndPromotionEvent $event) : void
     {
        if($event->getProduct()->getPromotions()->isEmpty()){
            $this->logger->info('ProductTest:  pas de promotion' );
        }
        else{
            $promotions = $event->getProduct()->getPromotions();

            foreach ($promotions as $promotion) {
                
                $this->productRepository->detachPromotion($event->getProduct(), $promotion);
            }
        }
     }
 }