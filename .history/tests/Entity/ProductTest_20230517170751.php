<?php
namespace Tests\Entity;
use App\Entity\Product;
use App\Entity\Promotion;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testGetId(): void
    {
        $product = new Product();
        $this->assertNull($product->getId());
    }

    public function testGetWording(): void
    {
        $product = new Product();
        $product->setWording('Wording');
        $this->assertSame('Wording', $product->getWording());
    }

    public function testGetPrice(): void
    {
        $product = new Product();
        $product->setProductPrice('10');
        $this->assertSame('10', $product->getProductPrice());
    }

    public function testGetProductPriceWithPromotion(): void
    {
        $product = new Product();
        $promotion = new Promotion();
        $product->setProductPrice('100');
        $promotion->setPromotionRate('10');
        $product->addPromotion($promotion);
        $this->assertSame(90, $product->getProductPrice());
    }
}
