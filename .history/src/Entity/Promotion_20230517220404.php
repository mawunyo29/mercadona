<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $promotion_start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $promotion_end = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: '0')]
    private ?string $promotion_rate = null;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'promotions')]
    private Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getPromotionRate() . '%';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPromotionStart(): ?\DateTimeInterface
    {
        return $this->promotion_start;
    }

    public function setPromotionStart(\DateTimeInterface $promotion_start): self
    {
        $this->promotion_start = $promotion_start;

        return $this;
    }

    public function getPromotionEnd(): ?\DateTimeInterface
    {
        return $this->promotion_end;
    }

    public function setPromotionEnd(\DateTimeInterface $promotion_end): self
    {
        $this->promotion_end = $promotion_end;

        return $this;
    }

    public function getPromotionRate(): ?string
    {
        return $this->promotion_rate;
    }

    public function setPromotionRate(string $promotion_rate): self
    {
        $this->promotion_rate = $promotion_rate;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->addPromotion($this);
            
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removePromotion($this);
        }

        return $this;
    }

    public function getPromotionPrice(Product $product): ?string
    {
        if (!$this->productCanNotBePromotedAtTheSameTime($product)) {
            $to_numeric =   $product->getProductPrice();
            
            $promotionPrice =  $to_numeric * (1 - $this->getPromotionRate() / 100);
            return $promotionPrice;
        }
        return $product->getProductPrice() ;
    }

    public function dateBetweenPromotion(): bool
    {
        $today = new \DateTime();
        return $today >= $this->getPromotionStart() && $today <= $this->getPromotionEnd();
    }
    public function productCanNotBePromotedAtTheSameTime(Product $product): bool
    {
        foreach ($product->getPromotions() as $promotion) {
            if ($promotion->dateBetweenPromotion()) {
                return true;
            }
        }
        return false;
    }
}
