<?php
declare(strict_types=1);

namespace Bank\Events;

use Carbon\CarbonImmutable;

interface EventWithTimestampInterface
{
    public function getTimestamp(): CarbonImmutable;
}