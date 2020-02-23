<?php
declare(strict_types=1);

namespace Bank;


use Carbon\CarbonImmutable;
use Bank\Events\DepositEvent;
use Bank\Events\WithdrawEvent;
use Bank\Statement\StatementRow;
use Bank\StatementPrinter\StatementPrinterInterface;
use Bank\Events\EventWithTimestampInterface as TimestampedEvent;

final class MyBankService implements BankService
{
    private array $events = [];
    
    private StatementPrinterInterface $statementPrinter;
    
    public function __construct(StatementPrinterInterface $statementPrinter)
    {
        $this->statementPrinter = $statementPrinter;
    }

    public function deposit(int $amount): void
    {
        $this->events[] = new DepositEvent($amount, CarbonImmutable::now());
    }

    public function withdraw(int $amount): void
    {
        $this->events[] = new WithdrawEvent($amount, CarbonImmutable::now());
    }

    public function printStatement(): void
    {
        $statement = $this->getStatement();

        $this->statementPrinter->printHeaderRowHelper();

        /** @var StatementRow $row */
        foreach ($statement as $row) {
            $this->statementPrinter->printStatementRowHelper($row);
        }
    }

    public function getStatement(): array
    {
        $statement = [];
        $balance = 0;
        
        \usort($this->events, fn(TimestampedEvent $a, TimestampedEvent $b) => $a->getTimestamp() <=> $b->getTimestamp());

        foreach ($this->events as $event) {
            if($event instanceof DepositEvent) {
                $amount = $event->getAmount();
            } elseif ($event instanceof WithdrawEvent) {
                $amount = -$event->getAmount();
            } else {
                throw new \Exception('Unexpected event found!');
            }
            
            $balance += $amount;
            
            $statement[] = new StatementRow($event->getTimestamp(), $amount, $balance);
        }
        
        return \array_reverse($statement);
    }
}