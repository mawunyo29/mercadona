<?php

namespace App\Event;

use App\Entity\Product;
use App\Entity\Promotion;
use Symfony\Contracts\EventDispatcher\Event;

class ProductEndPromotionEvent extends Event
{
    public const NAME = 'product.promotions';

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function __toString()
    {
        return $this->product->getProductPrice();
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getPromotions(): Object
    {
        return $this->product->getPromotions();
    }
}