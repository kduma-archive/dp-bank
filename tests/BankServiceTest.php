<?php
declare(strict_types=1);

namespace Tests\Bank;


use Carbon\Carbon;
use Bank\MyBankService;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;
use Bank\StatementPrinter\StatementPrinter;

final class BankServiceTest extends TestCase
{
    public function testSampleScenario()
    {
        $service = new MyBankService(new StatementPrinter());

        // (Given) Klient wpłacił depozyt 500 w dniu 02-02-2015
        $this->doOnSpecifiedDateHelper(new Carbon('02-02-2015'), fn() => $service->deposit(500));
        
        // (And) wpłacił 1000 w dniu 15-02-2015
        $this->doOnSpecifiedDateHelper(new Carbon('15-02-2015'), fn() => $service->deposit(1000));
        
        // (And) wypłacił 200 w dniu 17-02-2015
        $this->doOnSpecifiedDateHelper(new Carbon('17-02-2015'), fn() => $service->withdraw(200));
        
        // (Then) zobaczył:
        $this->expectOutputString(
            <<<EXPECTED_OUTPUT
            Data       || Kwota  || Saldo
            17/02/2015 || -200   || 1300
            15/02/2015 || 1000   || 1500
            02/02/2015 || 500    || 500
            
            EXPECTED_OUTPUT
        );
        
        // (When) wyświetlił listę transakcji,
        $service->printStatement();
    }

    protected function doOnSpecifiedDateHelper(Carbon $date, callable $callback)
    {
        CarbonImmutable::setTestNow($date);
        $callback();
        CarbonImmutable::setTestNow(null);
    }
}
