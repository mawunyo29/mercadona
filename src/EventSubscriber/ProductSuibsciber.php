<?php

namespace App\EventSubscriber;

use App\Entity\Product;
use App\Event\ProductEndPromotionEvent;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductSuibsciber implements EventSubscriberInterface
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ProductEndPromotionEvent::class => 'onEndPromotion',
        ];
    }

    public function onEndPromotion(ProductEndPromotionEvent $event): void
    {
        if($event->getProduct()->getPromotions()->isEmpty()){
            $this->logger->info('ProductTest:  pas de promotion' );
        }
        else{
            $this->logger->info('ProductTest: product_id: ' . $event->getProduct()->getId() . ' - product price:  ' . $event->getProduct()->getProductPrice()  );
        }
    }
}