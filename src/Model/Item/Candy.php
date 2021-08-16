<?php

declare(strict_types=1);

namespace App\Model\Item;


use App\AbstractClass\Item;

/**
 * Class Candy
 * @package App\Model\Item
 */
final class Candy extends Item
{
    /**
     * @var string
     */
    private string $name = "Candy";

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}