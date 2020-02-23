<?php
declare(strict_types=1);

namespace Bank\StatementPrinter;

use Bank\Statement\StatementRow;

interface StatementPrinterInterface
{
    public function printHeaderRowHelper(): void;

    public function printStatementRowHelper(StatementRow $row): void;
}