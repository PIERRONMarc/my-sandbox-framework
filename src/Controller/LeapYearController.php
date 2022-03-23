<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Service\YearService;

class LeapYearController
{
    public function index($year): Response
    {
        if (YearService::isLeapYear($year)) {
            return new Response('Yep, this is a leap year!');
        }

        return new Response('Nope, this is not a leap year.');
    }
}
