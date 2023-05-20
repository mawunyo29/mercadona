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

    /**
     * @var Category[]
     */
   public $categories = [];

    public function getSearchTerm(): ?string
    {
        return $this->search;
    }
}