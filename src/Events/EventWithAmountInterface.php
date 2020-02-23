<?php
declare(strict_types=1);

namespace Bank\Events;

interface EventWithAmountInterface
{
    public function getAmount(): int;
}