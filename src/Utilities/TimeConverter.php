<?php


namespace App\Utilities;

use App\util\DateTimeFormat;
use DateTimeImmutable;

class TimeConverter
{
    public function convertToUTC(\DateTimeZone $dateTimeZone, string $date): DateTimeImmutable
    {
        $dateTime = new DateTimeImmutable($date);
        $userTime = new DateTimeImmutable($dateTime->format(DateTimeFormat::DATE_TIME_FULL), $dateTimeZone);

        return $userTime->setTimezone(new DateTimeZone('UTC'));
    }
}