<?php
namespace Tests\Entity;
use App\Entity\Product;
use App\Entity\Promotion;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testGetProductPriceWithoutPromotion()
    {
        $product = new Product();
        $product->setProductPrice('10 €');
        $product->setWording('Test');
        $product->setProductDescription('Test');

        $result = $product->getProductPrice();

        $this->assertEquals('10 €', $result);
    }

    public function testGetProductPriceWithPromotion()
    {
        $promotion = new Promotion();
        $promotion->setPromotionRate(20); // Example promotion rate
        
        $product = new Product();
        $product->setProductPrice('100 €');
        $product->addPromotion($promotion);

        $result = $product->getProductPrice();

        $this->assertEquals('80 €', $result);
    }
}
