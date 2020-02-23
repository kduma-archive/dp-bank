<?php
declare(strict_types=1);

namespace Bank\StatementPrinter;


use Bank\Statement\StatementRow;

final class StatementPrinter implements StatementPrinterInterface
{
    public function printHeaderRowHelper(): void
    {
        $this->printRowHelper('Data', 'Kwota', 'Saldo');
    }

    public function printStatementRowHelper(StatementRow $row): void
    {
        $this->printRowHelper($row->getTimestamp()->format('d/m/Y'), (string) $row->getAmount(), (string) $row->getBalance());
    }

    protected function printRowHelper(string $date, string $amount, string $balance): void
    {
        echo \str_pad($date, 10);
        echo ' || ';
        echo \str_pad($amount, 6);
        echo ' || ';
        echo $balance;
        echo "\n";
    }
}