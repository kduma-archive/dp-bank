<?php 
declare(strict_types=1);

namespace Bank\Statement;


use Carbon\CarbonImmutable;

final class StatementRow
{
    protected int             $balance;
    protected int             $amount;
    protected CarbonImmutable $timestamp;

    public function __construct(CarbonImmutable $timestamp, int $amount, int $balance)
    {
        $this->amount = $amount;
        $this->balance = $balance;
        $this->timestamp = $timestamp;
    }

    public function getBalance(): int
    {
        return $this->balance;
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