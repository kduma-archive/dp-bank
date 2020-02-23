## Docplanner Bank

#### Cel zadania
1. Zaimplementuj bank, który udostępnia interfejs `Bank\BankService`.
2. Przykładowy scenariusz testowy:
```gherkin
(Given) Klient wpłacił depozyt 500 w dniu 02-02-2015
(And) wpłacił 1000 w dniu 15-02-2015
(And) wypłacił 200 w dniu 17-02-2015
(When) wyświetlił listę transakcji,
(Then) zobaczył:

Data       || Kwota  || Saldo
17/02/2015 || -200   || 1300
15/02/2015 || 1000   || 1500
02/02/2015 || 500    || 500
```

#### Założenia
1. Nie możesz zmienić wystawionego interfejsu banku.
2. Do skalarnego przedstawienia kwot używaj typu `integer` zamiast `float`.
3. Do wyświetlania danych możesz użyć nawet prostej instrukcji `echo` do konsoli.
4. Pokryj implementację testami tam gdzie uważasz, że będą przydatne.

#### Porady
1. W projekcie zainstalowany jest PHPStan do analizy statycznej i PHPCSFixer do poprawiania CodeStyle-u. Możesz je uruchomić za pomocą komendy `make phpstan` oraz `make php-cs-fixer`. Więcej informacji znajdziesz w pliku `Makefile`.
2. Możesz uruchomić PHPUnit za pomocą `make phpunit`. 
3. Nie zwracaj uwagi na liczbę spacji w wyświetlanej tabelce. Nie musi być idealna. :)
4. Gdy istnieje taka możliwość staraj się pracować na obiektach zamiast typach prostych.

#### Przykład odpalenia
Nie martw się, nie potrzebujesz żadnego frameworka ani dodatkowych narzędzi, by móc odpalać zadanie. Dla nas wystarczy jak napiszesz przykład wywołania banku jako zwykły plik `php` - dociągnij potrzebne pliki, stwórz obiekty i odpal metody. Przykład znajduje się poniżej.

```php
<?php
// Some magic
// new Bank(); etc
// Tutaj możesz sobie dociągnąć wymagane pliki, zbudować wszelkie klasy i ich użyć.
$bank->deposit(500);
$bank->deposit(1000);
$bank->withdraw(200);
$bank->printStatement();

>> OUTPUT:
Data       || Kwota  || Saldo
17/02/2015 || -200   || 1300
15/02/2015 || 1000   || 1500
02/02/2015 || 500    || 500
```
