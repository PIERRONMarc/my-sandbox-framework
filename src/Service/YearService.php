<?php

Namespace App\Service;

class YearService
{
    static public function isLeapYear($year): bool
    {
        if (null === $year) {
            $year = date('Y');
        }

        return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
    }
}
