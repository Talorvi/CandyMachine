<?php

declare(strict_types=1);

namespace App\Model\Item;


use App\AbstractClass\Item;

final class Candy extends Item
{
    private string $name = "Candy";

    public function getName(): string
    {
        return $this->name;
    }
}