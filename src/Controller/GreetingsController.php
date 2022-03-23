<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class GreetingsController
{
    public function hello($name): Response
    {
        return new Response(sprintf('Hello %s', $name));
    }

    public function bye(): Response
    {
        return new Response('Goodbye !');
    }
}
