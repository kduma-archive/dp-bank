<?php
declare(strict_types=1);

namespace Bank\Events;


use Carbon\CarbonImmutable;

final class DepositEvent implements EventWithAmountInterface, EventWithTimestampInterface
{
    protected int             $amount;
    protected CarbonImmutable $timestamp;

    public function __construct(int $amount, CarbonImmutable $timestamp)
    {
        $this->amount = $amount;
        $this->timestamp = $timestamp;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getTimestamp(): CarbonImmutable
    {
        return $this->timestamp;
    }
}