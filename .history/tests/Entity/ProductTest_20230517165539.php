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
}
