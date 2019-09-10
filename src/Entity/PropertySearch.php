<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     * @Assert\Range(min="10", max="400")
     */
    private $minSurface;

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @return int|null
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * @param int $max_price
     * @return PropertySearch
     */
    public function setMaxPrice(int $max_price): PropertySearch
    {
        $this->maxPrice = $max_price;
        return $this;
    }

    /**
     * @param int $min_surface
     * @return PropertySearch
     */
    public function setMinSurface(int $min_surface): PropertySearch
    {
        $this->minSurface = $min_surface;
        return $this;
    }
}