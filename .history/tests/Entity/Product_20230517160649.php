<?php
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testGetWording(): void
    {
        $product = new Product();
        $product->setWording('test');
        $this->assertEquals('test', $product);
    }
}
