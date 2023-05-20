<?php
namespace Tests\Entity;
use App\Entity\Product;

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
}
