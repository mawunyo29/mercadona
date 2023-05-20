<?php
namespace App\Model;

class SearchData
{
  /**
   * @var string
   */
   public ?string $search = '';

    /**
     * @var int
     */
    public ?int $page = 1;

    public function __toString(): string
    {
        return $this->search;
    }

    public function getSearchTerm(): ?string
    {
        return $this->search;
    }
}